<?php

namespace App\Interface\IService\Client;

use App\DTO\Vendor\EditVendorDTO;
use App\DTO\Vendor\CreateVendorDTO;

interface IClientVendorService
{
    public function createVendor(CreateVendorDTO $data);

    public function getSingleVendor($id);

    public function getAllVendorsForAParticularClient();

    public function getAllVendors();

    public function updateVendors(EditVendorDTO $data);

    public function deleteVendors($id);

    public function filterVendor();

}
