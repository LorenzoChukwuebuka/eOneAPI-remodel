<?php

namespace App\Services\Card;

use App\Exceptions\CustomValidationException;
use App\Interface\IService\Card\IPaymentService;
use Validator;

class PaymentService implements IPaymentService
{
    public function initialize_payment(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $validator = Validator::make($data, [
            "amount" => "required",
            "user_id" => "required",
            "card_id" => "required",
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
                "card_id" => $data["card_id"],
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
        $res = json_decode($result);

        return $res;

    }
    public function verify_payment()
    {}
    public function credit_user_account()
    {}
    public function debit_user_account()
    {}
    public function get_all_transactions_for_a_user()
    {}
    public function get_user_transactions()
    {}
}
