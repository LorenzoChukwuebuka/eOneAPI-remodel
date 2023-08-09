<?php

namespace App\Interface\IRepository\Card;

interface IPaymentRepository
{
    public function initialize_payment(object $data);
    public function verify_payment();
    public function credit_user_account();
    public function debit_user_account();
    public function get_all_transactions_for_a_user();
    public function get_user_transactions();
}
