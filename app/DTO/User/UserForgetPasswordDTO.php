<?php

namespace App\DTO\User;

class UserForgetPasswordDTO
{
    public function __construct(public string $username)
    {}
}
