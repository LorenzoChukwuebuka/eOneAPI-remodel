<?php

namespace App\DTO\Admin;

class AdminResetPasswordDTO
{
    public function __construct(public readonly string $email, public readonly string $password, public readonly string $password_confirmation, public string $token)
    {}
}
