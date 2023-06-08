<?php

namespace App\DTO\Admin;

class AdminResetPasswordDTO
{
    public function __construct(public string $email, public string $password, public string $password_confirmation, public string $token)
    {}
}
