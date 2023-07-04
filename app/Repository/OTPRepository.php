<?php 

namespace App\Repository;

use App\Interface\IRepository\IOTPRepository;

class OTPRepository implements IOTPRepository{
    public function createOTP(CreateOTPDTO $data){}
    public function deleteOTP($id){}
    public function retrieveOTP(){}
}