<?php

namespace App\Interface\IService\Admin;

use App\DTO\Admin\AdminEditVendorDTO;
use App\DTO\Admin\AdminCreateVendorDTO;

interface IAdminVendorService
{
    public function createVendor(AdminCreateVendorDTO $data);
    public function getSingleVendor($id);
    public function getAllVendors();
    public function updateVendor(AdminEditVendorDTO $data);
    public function deleteVendor($id);
}
