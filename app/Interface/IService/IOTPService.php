<?php

namespace App\Interface\IService;

interface IOTPService
{
    public function createOTP();
    public function deleteOTP();
    public function retrieveOTP();
}
