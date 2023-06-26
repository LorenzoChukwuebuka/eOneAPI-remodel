<?php 
namespace  App\DTO\Vendor;


class EditVendorDTO
{
    public function __construct(public int $id, public  ? int $client_id = null, public  ? string $category = null, public  ? string $business_name = null, public  ? string $region = null, public  ? string $state = null, public  ? string $city = null, public  ? string $address = null, public  ? string $email = null, public  ? string $phone_number = null, public  ? string $logo, public  ? string $longitude = null, public  ? string $latitude = null)
    {}
}