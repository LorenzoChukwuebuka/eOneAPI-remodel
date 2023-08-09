<?php

namespace App\Services\Card;

use App\Interface\IService\Card\IPaymentService;

class PaymentService implements IPaymentService
{
    public function initialize_payment(object $data)
    {
        return $data;
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
