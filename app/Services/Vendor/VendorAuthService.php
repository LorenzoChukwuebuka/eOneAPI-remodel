<?php

namespace App\Services\Vendor;

use App\Custom\MailSender;
use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\DTO\Vendor\VerifyVendorDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;
use App\Interface\IService\IOTPService;
use App\Interface\IService\Vendor\IVendorAuthService;
use Illuminate\Support\Str;
use Validator;

class VendorAuthService implements IVendorAuthService
{

    public function __construct(IVendorAuthRepository $vendorRepository, IOTPService $otpService)
    {
        $this->vendorRepository = $vendorRepository;
        $this->otpService = $otpService;

    }
    public function login(VendorLoginDTO $data)
    {
        $validator = Validator::make((array) $data, [
            'username' => 'required|exists:vendors',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $email_verified = $this->vendorRepository->login($data);

        if ($email_verified["data"]["email_verified_at"] == null) {
            throw new \Exception("vendor has not been verified");
        }

        return $email_verified;

    }

    public function verifyVendor(VerifyVendorDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "token" => "required|exists:o_t_p_s",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $otpFind = $this->otpService->retrieveOTP($data);

        if ($otpFind == null) {
            throw new \Exception("Wrong token provided");
        }

        #if found retrieve the user id and update the user row

        $data->user_id = $otpFind->user_id;

        $this->vendorRepository->verifyVendor($data);

        return $this->otpService->deleteOTP($data->token);

    }
    public function changePassword()
    {}

    public function forgotPassword(VendorForgetPasswordDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "email" => "email|required|exists:vendors",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $token = Str::random(7);

        $data->token = $token;

        $repo = $this->vendorRepository->forgotPassword($data);

        MailSender::vendorForgetPassword($data->email, $repo, $token);

        return "email sent";
    }


    public function resetPassword(VendorResetPasswordDTO $data)
    {}
}
