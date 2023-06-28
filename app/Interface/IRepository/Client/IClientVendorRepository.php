<?php

namespace App\Interface\IRepository\Client;

use App\DTO\Vendor\CreateVendorDTO;
use App\DTO\Vendor\EditVendorDTO;

interface IClientVendorRepository
{
    public function createVendor(CreateVendorDTO $data);

    public function getSingleVendor($id);

    public function getAllVendorsForAParticularClient(int $id);

    public function getAllVendors();

    public function updateVendors(EditVendorDTO $data);

    public function deleteVendors($id);

    public function filterVendor();
}
