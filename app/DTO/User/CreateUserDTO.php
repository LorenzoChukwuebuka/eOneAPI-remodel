<?php

namespace App\DTO\User;

class CreateUserDTO
{
    public function __construct(public string $firstName, public string $lastName, public string $username, public  ? string $email = null, public string $phoneNumber, public string $password, public string $status)
    {

    }

}
