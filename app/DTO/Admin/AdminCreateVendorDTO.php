<?php
namespace App\DTO\Admin;

class AdminCreateVendorsDTO
{
    public function __construct(public int $clientId, public string $category, public string $business_name, public string $region, public string $state, public string $city, public string $address, public string $email, public string $phone_number, public  ? string $longitude = null, public  ? string $latitude = null, public string $password)
    {

    }

}
