<?php

namespace App\DTO\User;

class UserLoginDTO
{
    public function __construct(public readonly ?string $username = null, public readonly ?string $password = null)
    {

    }

}
