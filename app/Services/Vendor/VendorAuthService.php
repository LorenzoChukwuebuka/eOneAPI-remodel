<?php

namespace App\Services\Vendor;

use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;
use App\Interface\IService\Vendor\IVendorAuthService;
use Validator;

class VendorAuthService implements IVendorAuthService
{

    public function __construct(IVendorAuthRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
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

        return $this->vendorRepository->login($data);

    }
    public function changePassword()
    {}
    public function forgotPassword(VendorForgetPasswordDTO $data)
    {}
    public function resetPassword(VendorResetPasswordDTO $data)
    {}
}
