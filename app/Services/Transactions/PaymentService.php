<?php

namespace App\Services\Transactions;

use Validator;
use App\Models\Wallet;
use App\Custom\MailSender;
use Illuminate\Support\Str;
use App\Models\VendorWallet;
use App\DTO\Card\FundCardDTO;
use App\DTO\Card\DebitCardDTO;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomValidationException;
use App\Interface\IService\Card\IPaymentService;
use App\Interface\IRepository\Card\ICardRepository;
use App\Interface\IRepository\Card\IPaymentRepository;
use App\Interface\IRepository\Card\ICardTransactionRepository;
use App\Interface\IRepository\Vendor\IVendorTransactionRepository;

class PaymentService implements IPaymentService
{

    public function __construct(IPaymentRepository $paymentRepository, ICardTransactionRepository $cardTransactionRepository, ICardRepository $cardRepository, IVendorTransactionRepository $vendorTransactionRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->cardTransactionRepository = $cardTransactionRepository;
        $this->cardRepository = $cardRepository;
        $this->vendorTransactionRepository = $vendorTransactionRepository;
    }

    public function initialize_payment(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $validator = Validator::make($data, [
            "amount" => "required",
            "user_id" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $key = config('paystack.paystack_secret');

        $url = "https://api.paystack.co/transaction/initialize";

        $fields = [
            'email' => auth()->user()->email,
            'amount' => $data["amount"] * 100,
            'metadata' => json_encode([
                "user_id" => auth()->user()->id,
                "payer_email" => auth()->user()->email,
            ]),

        ];

        $fields_string = http_build_query($fields);

        #open connection
        $ch = curl_init();

        #set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer {$key}",
            "Cache-Control: no-cache",
        ));

        #So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        #execute post
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $res = json_decode($result);

        return $res;

    }
    public function verify_payment(string $reference)
    {
        $key = config('paystack.paystack_secret');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$key}",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception("Curl Error: {$err}");
        }

        $result = json_decode($response);

        if ($result->data->status !== 'success') {
            throw new \Exception("Transaction failed");
        }

        $user_id = $result->data->metadata->user_id;
        $amount = $result->data->amount / 100;
        $email = $result->data->metadata->payer_email;
        $reference = $result->data->reference;
        $status = $result->data->status;

        #check if referal already exists in db

        $this->paymentRepository->check_if_reference_exists($reference);

        if ($this->paymentRepository !== null) {
            throw new \Exception("Possible duplicate transaction");
        }

        #begin the payment process using a db::transaction

        return DB::transaction(function () use ($user_id, $amount, $email, $reference, $status) {
            $data = (object) [
                'user_id' => $user_id,
                'amount' => $amount,
                'transaction_type' => 'credit',
                'reference' => $reference,
                'status' => $status,
                'meta_data' => 'paystack wallet funding',
            ];

            $payment = $this->paymentRepository->create_transaction($data);

            if ($payment) {
                #check the balance of the user

                $previous_balance = DB::select('SELECT ifnull((select available_balance from wallets where user_id = ?  order by id desc limit 1), 0 ) AS prevbal', [$user_id]);

                #fund user's wallet

                $wallet = Wallet::updateOrCreate(['user_id' => $user_id],
                    [
                        "available_balance" => (int) $amount + (int) $previous_balance[0]->prevbal,
                    ]);
            }

            return MailSender::SendCreditMail(auth()->user()->email, auth()->user()->username, $amount);
        });

    }

    public function fund_card(FundCardDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "card_id" => "required",
            "amount" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return DB::transaction(function () use ($data) {

            #get previous card balance
            $previous_card_balance = DB::select('SELECT ifnull((select card_balance from cards where id = ?  order by id desc limit 1), 0 ) AS prevbal', [$data->card_id]);
            #add the previous balance to the amount to get the current the current balance
            $current_card_balance = (int) $previous_card_balance[0]->prevbal + (int) $data->amount;

            $transactionRef = Str::random(10);

            #create a card credit transaction
            $transaction_data = (object) [
                'card_id' => $data->card_id,
                'amount' => $data->amount,
                'previous_balance' => $previous_card_balance[0]->prevbal,
                'current_balance' => $current_card_balance,
                'transaction_ref' => $transactionRef,
                'transaction_type' => 'credit',
            ];

            $card_credit_transaction = $this->cardTransactionRepository->create_card_transaction($transaction_data);

            #add balance to card

            $card = $this->cardRepository->find_card($data->card_id);

            if ($card == null) {
                throw new \Exception("Invalid card chosen");

            }

            #update card with the current balance

            $card->card_balance = $current_card_balance;

            $card->save();

            #create a wallet debit transaction

            $wallet_debit_transaction_data = (object) [
                'user_id' => auth()->user()->id,
                'amount' => $data->amount,
                'transaction_type' => 'debit',
                'reference' => $transactionRef,
                'status' => 'success',
                'meta_data' => 'card funding',
                'card_id' => $data->card_id,
            ];

            $wallet_debit_transaction = $this->paymentRepository->create_transaction($wallet_debit_transaction_data);

            #check for previous wallet balance

            $previous_wallet_balance = DB::select('SELECT ifnull((select available_balance from wallets where user_id = ?  order by id desc limit 1), 0 ) AS prevbal', [auth()->user()->id]);

            if ($data->amount > (int) $previous_wallet_balance[0]->prevbal) {
                throw new \Exception("Insuffient balance on wallet. Kindly top up your wallet");
            }

            #debit wallet

            $wallet = Wallet::updateOrCreate(['user_id' => auth()->user()->id],
                [
                    "available_balance" => (int) $previous_wallet_balance[0]->prevbal - (int) $data->amount,
                ]);

            # if everything went well...
            #update transaction card status to success

            $updateCardTransactionStatus = $this->cardTransactionRepository->find_transaction($card_credit_transaction->id);

            $updateCardTransactionStatus->status = 'success' ?? 'failed';

            $updateCardTransactionStatus->save();

        });

    }

    public function debit_card(DebitCardDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "card_id" => "required",
            "amount" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return DB::transaction(function () use ($data) {

            #pull the neccessary information from the card
            $card = $this->cardRepository->find_card($data->card_id);

            $vendorId = $card->vendor_id;
            $accountType = $card->account_type_id;
            $limit = $card->card_limit;

            #for debit cards
            if (($accountType == 2) && (int) $data->amount > (int) $card->card_balance) {
                throw new \Exception("Insufficient card balance. Kindly top up your card to enjoy our services");
            }

            #for credit cards
            if (($accountType == 1) && ($card->card_balance + (-1 * $data->amount) < $limit)) {
                throw new \Exception("Card limit has been  exceeded for this card");
            }

            #get previous card balance
            $previous_card_balance = DB::select('SELECT ifnull((select card_balance from cards where id = ?  order by id desc limit 1), 0 ) AS prevbal', [$data->card_id]);
            #add the previous balance to the amount to get the current the current balance
            $current_card_balance = (int) $previous_card_balance[0]->prevbal - (int) $data->amount;

            $transactionRef = Str::random(10);

            #create debit transaction

            #create a card credit transaction
            $card_debit_transaction_data = (object) [
                'card_id' => $data->card_id,
                'amount' => $data->amount,
                'previous_balance' => $previous_card_balance[0]->prevbal,
                'current_balance' => $current_card_balance,
                'transaction_ref' => $transactionRef,
                'transaction_type' => 'debit',
            ];

            $card_debit_transaction = $this->cardTransactionRepository->create_card_transaction($card_debit_transaction_data);

            #add balance to card

            $card = $this->cardRepository->find_card($data->card_id);

            if ($card == null) {
                throw new \Exception("Invalid card chosen");
            }

            #update card with the current balance
            $card->card_balance = $current_card_balance;

            $card->save();

            #credit vendor account

            #normally a percentage of the payment should to the vendor
            #pending task for now

            $vendor_credit_transaction_data = (object) [
                "vendor_id" => $vendorId,
                "amount" => $data->amount,
                "transaction_type" => 'credit',
                "transaction_reference" => $transactionRef,
                "card_transaction_id" => $card_debit_transaction->id,
                "status" => "successful",
                "meta_data" => "successful transaction",
            ];

            $vendor_credit_transaction = $this->vendorTransactionRepository->create_vendor_transaction($vendor_credit_transaction_data);

            #credit vendor wallet

            $vendor_wallet_previous_balance = DB::select('SELECT ifnull((select available_balance from vendor_wallets where vendor_id = ?  order by id desc limit 1), 0 ) AS prevbal', [$card->vendor_id]);

            #fund user's wallet

            $vendor_wallet = VendorWallet::updateOrCreate(['vendor_id' => $card->vendor_id],
                [
                    "available_balance" => (int) $data->amount + (int) $vendor_wallet_previous_balance[0]->prevbal,
                ]);

        });

          # if everything went well...
            #update transaction card status to success

            $updateCardTransactionStatus = $this->cardTransactionRepository->find_transaction($card_credit_transaction->id);

            $updateCardTransactionStatus->status = 'success' ?? 'failed';

            $updateCardTransactionStatus->save();
    }

    public function get_all_transactions_for_a_user()
    {}
    public function get_user_transactions()
    {}

}
