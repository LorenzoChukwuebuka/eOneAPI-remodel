<?php

namespace App\Interface\IRepository;

use App\DTO\OTP\CreateOTPDTO;

interface IOTPRepository
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($token);
    public function retrieveOTP(object $data);
}
