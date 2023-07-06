<?php

namespace App\Services;

use App\DTO\Client\VerifyClientDTO;
use App\DTO\OTP\CreateOTPDTO;
use App\DTO\User\VerifyUserDTO;
use App\DTO\Vendor\VerifyVendorDTO;
use App\Interface\IRepository\IOTPRepository;
use App\Interface\IService\IOTPService;

class OTPService implements IOTPService
{
    public function __construct(IOTPRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }
    public function createOTP(CreateOTPDTO $data)
    {
        return $this->otpRepository->createOTP($data);
    }
    public function deleteOTP($token)
    {
        return $this->otpRepository->deleteOTP($token);
    }
    public function retrieveOTP(object $data)
    {
        return $this->otpRepository->retrieveOTP($data);
    }
}
