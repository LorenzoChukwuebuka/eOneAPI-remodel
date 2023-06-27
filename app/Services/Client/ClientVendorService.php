<?php

namespace App\Services\Client;

use App\DTO\Vendor\EditVendorDTO;
use App\DTO\Vendor\CreateVendorDTO;

class ClientVendorService implements IClientVendorService
{
    public function createVendor(CreateVendorDTO $data)
    {}

    public function getSingleVendor($id)
    {}

    public function getAllVendorsForAParticularClient()
    {}

    public function getAllVendors()
    {}

    public function updateVendors(EditVendorDTO $data)
    {}

    public function deleteVendors($id)
    {}

    public function filterVendor()
    {}
}
