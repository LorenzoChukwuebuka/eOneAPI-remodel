<?php

namespace App\DTO\Admin;

class AdminClientDTO
{
    public function __construct(public string $businessname, public string $region, public string $state, public string $city, public string $address, public  ? string $email = null, public string $pin, public  ? string $phone_number = null)
    {}
}
