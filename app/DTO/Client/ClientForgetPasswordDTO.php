<?php

namespace App\DTO\Client;

class ClientForgetPasswordDTO
{
    public function __construct(public  ? string $email = null)
    {}
}
