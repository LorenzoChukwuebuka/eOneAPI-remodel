<?php

namespace App\DTO\User;

class VerifyUserDTO
{
    public function __construct( public readonly ?string $token = null)
    {

    }

}
