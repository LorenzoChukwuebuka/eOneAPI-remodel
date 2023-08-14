<?php

namespace App\DTO\User;

class CreateUpdateTransactionPinDTO
{
    public function __construct(public readonly ?string $transaction_pin = null)
    {}
}
