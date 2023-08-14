<?php

namespace App\DTO\Card;

class DebitCardDTO
{
    public function __construct(public int | float $amount)
    {

    }
}
