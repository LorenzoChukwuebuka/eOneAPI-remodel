<?php 
namespace  App\DTO\Vendor;

class VendorResetPasswordDTO{
    public function __construct(public string $password, public int | string $otp){}
}