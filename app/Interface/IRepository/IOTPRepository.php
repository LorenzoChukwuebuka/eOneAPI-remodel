<?php

namespace App\Interface\IRepository;

use App\DTO\OTP\CreateOTPDTO;

interface IOTPRepository
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($id);
    public function retrieveOTP();
}
