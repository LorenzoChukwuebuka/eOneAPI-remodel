<?php

namespace App\Interface\IService\Vendor;

interface IVendorAuthService
{
    public function login();
    public function changePin();
    public function forgotPin();
    public function resetPin();
}
