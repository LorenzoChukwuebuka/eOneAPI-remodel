<?php

namespace App\Services\Card;

use App\DTO\Card\CreateUserCardDTO;
use App\DTO\Card\FundCardDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Card\ICardRepository;
use App\Interface\IService\Card\ICardService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Validator;

class CardService implements ICardService
{
    public function __construct(ICardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }
    public function create_card_for_users(CreateUserCardDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "user_id" => "required",
            "vendor_id" => "required",
            "pin" => "required|min:4",
            "card_type_id" => "required",
            "account_type_id" => "required",
            "interest_rate" => [],
            "card_limit" => [],
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return DB::transaction(function () use ($data) {
            $genCardNum = $this->generateVirtualCardNumber();

            $check_if_card_exists = $this->cardRepository->check_if_generated_number_exists($genCardNum);

            if ($check_if_card_exists !== null) {

                #Generate a new card number until a unique one is found
                do {
                    $genCardNum = $this->generateVirtualCardNumber();
                    $check_if_card_exists = $this->cardRepository->check_if_generated_number_exists($genCardNum);
                } while ($check_if_card_exists);

            }

            $encryptedCardNumb = Crypt::encrypt($genCardNum);

            $data->card_number = $encryptedCardNumb;

            #call the expire function
            $today = date("F j, Y, g:i a");
            $expiryDate = self::expiry_date($today);

            $data->expiry_date = $expiryDate;

            #send mail to user about card creation
            /**
             * get the email or phone number of user from their
             */

            return $this->cardRepository->create_card_for_users($data);

        });

    }

   

    public function get_all_cards_for_a_particular_vendor()
    {
        $id = auth()->user()->id;

        $result = $this->cardRepository->get_all_cards_for_a_particular_vendor($id);

        if ($result->count() == 0) {
            throw new \Exception("No records found");
        }

        return $result;
    }

    public function edit_card_status()
    {}

    public function get_user_cards($id = null)
    {
        $card = $this->cardRepository->get_user_cards($id);

        if (!$card) {
            throw new \Exception("No card found");
        }

        return $card;

    }

    public function get_account_type()
    {
        return $this->cardRepository->get_account_type();
    }

    public function get_card_type()
    {
        return $this->cardRepository->get_card_type();
    }

    private static function expiry_date($today)
    {
        $date = date_create($today);
        date_add($date, date_interval_create_from_date_string("3 years"));
        return date_format($date, "Y-m-d");
    }

    private function generateRandomNumbers($length)
    {
        $numbers = '';
        for ($i = 0; $i < $length; $i++) {
            $numbers .= mt_rand(0, 9); // Generate a random digit
        }
        return $numbers;
    }

    private function calculateLuhnChecksum($number)
    {
        $sum = 0;
        $numDigits = strlen($number);
        $parity = $numDigits % 2;

        for ($i = $numDigits - 1; $i >= 0; $i--) {
            $digit = intval($number[$i]);

            if ($i % 2 == $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        $checksumDigit = (10 - ($sum % 10)) % 10;
        return $checksumDigit;
    }

    private function generateVirtualCardNumber($length = 16)
    {
        $bin = "453245"; // Issuer Identifier (BIN)
        $accountIdentifier = $this->generateRandomNumbers($length - strlen($bin) - 1); // Subtract 1 for the checksum
        $cardNumber = $bin . $accountIdentifier;
        $checksum = $this->calculateLuhnChecksum($cardNumber);

        return $cardNumber . $checksum;
    }
}
