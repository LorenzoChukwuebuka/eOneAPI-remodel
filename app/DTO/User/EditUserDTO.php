<?php

namespace App\DTO\User;

class EditUserDTO
{
    public function __construct(public int $id, public string $firstName, public string $lastName, public string $username, public ?string $email = null, public string $phone_number)
    {}
}
