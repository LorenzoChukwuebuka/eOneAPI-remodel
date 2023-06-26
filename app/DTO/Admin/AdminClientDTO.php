<?php

namespace App\DTO\Admin;

class AdminClientDTO
{
    public function __construct(public  ? string $businessname = null, public  ? string $region = null, public  ? string $state = null, public string $city, public string $address, public  ? string $email = null, public  ? string $pin = null, public  ? string $phone_number = null)
    {}
}
