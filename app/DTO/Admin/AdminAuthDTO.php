<?php

namespace App\DTO\Admin;

class AdminAuthDTO
{
    public function __construct(public readonly  ? string $email = null, public readonly  ? string $password = null)
    {}
}
