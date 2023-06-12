<?php

namespace App\Interface\IRepository\Admin;

use App\DTO\Admin\AdminEditVendorDTO;
use App\DTO\Admin\AdminCreateVendorDTO;

interface IAdminVendorRepository{
    public function createVendor(AdminCreateVendorDTO $data);
    public function getSingleVendor($id);
    public function getAllVendors();
    public function updateVendor(AdminEditVendorDTO $data);
    public function deleteVendor($id);
}