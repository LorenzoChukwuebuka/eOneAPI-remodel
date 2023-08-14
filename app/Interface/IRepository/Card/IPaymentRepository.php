<?php

namespace App\Interface\IRepository\Card;

interface IPaymentRepository
{

    public function create_credit_transaction(object $data);
    public function debit_user_account();
    public function get_all_transactions_for_a_user();
    public function get_user_transactions();
    public function check_if_referal_exists($referal);
}
