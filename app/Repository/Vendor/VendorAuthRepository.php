<?php 

namespace App\Repository\Vendor;

use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;

class VendorAuthRepository implements IVendorAuthRepository{
    public function login(VendorLoginDTO $data){
        
    }
    public function changePassword(){
        
    }
    public function forgotPassword(VendorForgetPasswordDTO $data){
        
    }
    public function resetPassword(VendorResetPasswordDTO $data){
        
    }
}