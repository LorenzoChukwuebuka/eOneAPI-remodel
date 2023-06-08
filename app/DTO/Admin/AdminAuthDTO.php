<?php

namespace App\DTO\Admin;

class AdminAuthDTO
{
    public function __construct(public string $email, public string $password)
    {}
}
