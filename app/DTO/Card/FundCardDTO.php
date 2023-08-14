<?php

namespace App\DTO\Card;

class FundCardDTO
{
    public function __construct(public int | float $amount,public int $card_id)
    {}
}
