<?php

namespace App\DTO\Card;

class CreateUserCardDto
{

    public function __construct(public string $pin, public int $user_id, public int $vendor_id, public int $card_type_id, public int $account_type_id, public ?int $interest_rate = null)
    {

    }

}
