<?php

namespace App\Repository;

use App\Models\OTP;
use App\DTO\OTP\CreateOTPDTO;
use App\Interface\IRepository\IOTPRepository;

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
            "card_id" => $data->card_id ?? null,
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
