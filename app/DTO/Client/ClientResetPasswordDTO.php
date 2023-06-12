<?php 

namespace App\DTO\Client;

class ClientResetPasswordDTO
{
    public function __construct(public int $otp,public string $pin)
    {}
    
}