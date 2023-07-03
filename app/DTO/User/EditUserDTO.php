<?php

namespace App\DTO\User;

class EditUserDTO
{
    public function __construct(public int $id, public ?string $firstName = null, public ?string $lastName = null, public ?string $username = null, public ?string $email = null, public ?string $phone_number = null)
    {}
}
