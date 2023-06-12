<?php 

namespace App\DTO\Client;

class ClientLoginDTO{
    public function __construct(public string $email, public string $pin)
    {}
}