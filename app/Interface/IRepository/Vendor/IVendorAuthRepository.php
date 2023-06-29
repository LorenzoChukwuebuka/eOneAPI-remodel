<?php 

namespace App\Interface\IRepository\Vendor;

use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\DTO\Vendor\VendorForgetPasswordDTO;

interface IVendorAuthRepository{
    public function login(VendorLoginDTO $data);
    public function changePassword();
    public function forgotPassword(VendorForgetPasswordDTO $data);
    public function resetPassword(VendorResetPasswordDTO $data);
}