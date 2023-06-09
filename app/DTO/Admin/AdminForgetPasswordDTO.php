<?php

namespace App\DTO\Admin;

class AdminForgetPasswordDTO
{
    public function __construct(public readonly string $email)
    {}
}
