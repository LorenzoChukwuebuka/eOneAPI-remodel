<?php

namespace App\Interface\IRepository\Card;

interface ICardTransactionRepository
{
    public function create_card_transaction(object $data);
    public function find_transaction($id);


}
