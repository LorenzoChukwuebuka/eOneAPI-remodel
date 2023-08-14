<?php

namespace App\Interface\IRepository\Card;

interface IPaymentRepository
{

    public function create_transaction(object $data);
    public function get_all_transactions_for_a_user();
    public function get_user_transactions();
    public function check_if_reference_exists($referal);
}
