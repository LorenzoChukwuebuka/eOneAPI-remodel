<?php

namespace App\DTO\Admin;

class AdminAuthDTO
{
    public function __construct(public readonly string $email, public readonly string $password)
    {}
}
