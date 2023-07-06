<?php

namespace App\DTO\Client;

class VerifyClientDTO
{
    public function __construct( public readonly ?string $token = null)
    {

    }

}