<?php

namespace App\Interface\IService;

use App\DTO\OTP\CreateOTPDTO;
use App\DTO\User\VerifyUserDTO;
use App\DTO\Client\VerifyClientDTO;
use App\DTO\Vendor\VerifyVendorDTO;

interface IOTPService
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($token);
    public function retrieveOTP(object $data);
}
