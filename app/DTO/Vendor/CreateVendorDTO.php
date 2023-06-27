<?php 

namespace  App\DTO\Vendor;

class CreateVendorDTO
{
    public function __construct(public int $client_id, public  ? string $category = null, public ? string $business_name = null, public ? string $region = null, public string $state, public string $city, public string $address, public string $email, public string $phone_number, public  ? string $logo = null, public  ? string $longitude = null, public  ? string $latitude = null, public string $password)
    {

    }

}