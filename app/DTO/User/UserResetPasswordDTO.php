<?php

namespace App\DTO\User;

class UserResetPasswordDTO{
    
    public function __construct(public string $password, public int | string $otp)
    {}

}