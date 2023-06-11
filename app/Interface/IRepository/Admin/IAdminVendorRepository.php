<?php

namespace App\Interface\IRepository\Admin;

interface IAdminVendorService{
    public function createVendor();
    public function getSingleVendor();
    public function getAllVendors();
    public function updateVendor();
    public function deleteVendor();
}