<?php

namespace App\Interface\IRepository;

use App\DTO\OTP\CreateOTPDTO;
use App\DTO\User\VerifyUserDTO;

interface IOTPRepository
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($token);
    public function retrieveOTP(VerifyUserDTO $data);
}
