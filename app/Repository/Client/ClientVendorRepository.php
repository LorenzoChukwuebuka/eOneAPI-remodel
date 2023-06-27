<?php

namespace App\Repository\Client;

use App\DTO\Vendor\EditVendorDTO;
use App\DTO\Vendor\CreateVendorDTO;
use App\Interface\IRepository\Client\IClientVendorRepository;

class ClientVendorRepository implements IClientVendorRepository
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
