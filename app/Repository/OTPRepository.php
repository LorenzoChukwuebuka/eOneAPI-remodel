<?php

namespace App\Repository;

use App\DTO\OTP\CreateOTPDTO;
use App\Interface\IRepository\IOTPRepository;
use App\Models\OTP;

class OTPRepository implements IOTPRepository
{
    public function __construct(OTP $otpModel)
    {
        $this->otpModel = $otpModel;
    }
    public function createOTP(CreateOTPDTO $data)
    {
        return $this->otpModel::create([
            'token' => $data->token,
            "user_id" => $data->user_id,
        ]);
    }
    public function deleteOTP($token)
    {
        $otp = $this->otpModel::where('token', $token)->first();

        return $otp->delete();
    }
    public function retrieveOTP(object $data)
    {

        return $this->otpModel::where('token', $data->token)->first();

    }
}
