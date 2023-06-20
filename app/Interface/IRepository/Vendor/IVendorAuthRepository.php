<?php 

namespace App\Interface\IRepository\Vendor;

interface IVendorAuthRepository{
    public function login();
    public function changePin();
    public function forgotPin();
    public function resetPin();
}