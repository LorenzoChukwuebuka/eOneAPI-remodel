<?php

namespace App\DTO\Card;

class CreateCardHistoryDTO
{
    public function __construct(public readonly string $cardNumber, public readonly string $data, public readonly string $remark)
    {}
}
