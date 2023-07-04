<?php

namespace App\Interface\IService;

interface IOTPService
{
    public function createOTP(CreateOTPDTO $data);
    public function deleteOTP($id);
    public function retrieveOTP();
}
