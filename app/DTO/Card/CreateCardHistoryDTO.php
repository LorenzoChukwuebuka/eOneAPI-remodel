<?php

namespace App\DTO\Card;

class CreateCardHistoryDTO
{
    public function __construct(public string $cardNumber, public string $data, public string $remark)
    {}
}
