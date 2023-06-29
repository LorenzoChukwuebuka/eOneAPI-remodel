<?php

namespace App\DTO\User;

class UserLoginDTO{
    public function __construct(public string $username, public string $password)
    {

    }

}