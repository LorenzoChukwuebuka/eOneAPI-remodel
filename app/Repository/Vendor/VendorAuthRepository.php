<?php

namespace App\Repository\Vendor;

use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;
use App\Models\Vendor;

class VendorAuthRepository implements IVendorAuthRepository
{
    public function __construct(Vendor $vendorModel)
    {
        $this->vendorModel = $vendorModel;
    }

    public function login(VendorLoginDTO $data)
    {
        $vendor = $this->vendorModel::where('username', $data->username)->first();
        #compare passwords

        $comparePasswords = \password_verify($data->password, $vendor->password);

        if (!$comparePasswords) {
            throw new \Exception("Password does not match", 1);
        }
        $token = $vendor->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'vendor',
            'token' => $token,
            'data' => $vendor,
        ];
    }
    public function changePassword()
    {

    }
    public function forgotPassword(VendorForgetPasswordDTO $data)
    {

    }
    public function resetPassword(VendorResetPasswordDTO $data)
    {

    }
}
