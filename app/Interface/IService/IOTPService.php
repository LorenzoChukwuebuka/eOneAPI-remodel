<?php

namespace App\Interface\IService;

use App\DTO\OTP\CreateOTPDTO;
use App\DTO\User\VerifyUserDTO;

interface IOTPService
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($id);
    public function retrieveOTP(VerifyUserDTO $data);
}
