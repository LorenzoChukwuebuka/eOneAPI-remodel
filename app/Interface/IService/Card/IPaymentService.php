<?php

namespace App\Interface\IService\Card;

use App\DTO\Card\FundCardDTO;
use App\DTO\Card\DebitCardDTO;

interface IPaymentService
{
    public function initialize_payment(array $data);
    public function verify_payment(string $reference);
    public function get_all_transactions_for_a_user();
    public function get_user_transactions();
    public function fund_card(FundCardDTO $data);
    public function debit_card(DebitCardDTO $data);
}
