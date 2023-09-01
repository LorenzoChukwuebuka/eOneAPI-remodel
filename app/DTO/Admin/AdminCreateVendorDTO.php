<?php
namespace App\DTO\Admin;

class AdminCreateVendorDTO
{
    public function __construct(public int $client_id, public ?string $category = null, public string $business_name, public string $region, public string $state, public string $city, public string $address, public string $email, public string $phone_number, public ?string $logo = null, public ?string $longitude = null, public ?string $latitude = null, public string $password, public string $username)
    {

    }

}
