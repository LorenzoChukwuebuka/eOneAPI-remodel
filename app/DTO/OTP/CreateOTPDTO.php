<?php

namespace App\DTO\OTP;

class CreateOTPDTO
{
    public function __construct(public readonly string $user_id, public readonly string $token)
    {}
}
