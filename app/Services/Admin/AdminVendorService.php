<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminCreateVendorDTO;
use App\DTO\Admin\AdminEditVendorDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Admin\IAdminVendorRepository;
use App\Interface\IService\Admin\IAdminVendorService;
use Validator;

class AdminVendorService implements IAdminVendorService
{
    public function __construct(private IAdminVendorRepository $adminVendorRepository)
    {
        $this->adminVendorRepository = $adminVendorRepository;
    }
    public function createVendor(AdminCreateVendorDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "client_id" => "required",
            "category" => [],
            "business_name" => "required",
            "region" => "required",
            "state" => "required",
            "city" => "required",
            "address" => "required",
            "email" => "required|unique:vendors",
            "longitude" => [],
            "latitude" => [],
            "password" => "required|min:6",
            "phone_number" => "required|min:11",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->adminVendorRepository->createVendor($data);
    }
    public function getSingleVendor($id)
    {
        return $this->adminVendorRepository->getSingleVendor($id);
    }
    public function getAllVendors()
    {
        return $this->adminVendorRepository->getAllVendors();
    }
    public function updateVendor(AdminEditVendorDTO $data)
    {
        return $this->adminVendorRepository->updateVendor($data);
    }
    public function deleteVendor($id)
    {
        return $this->adminVendorRepository->deleteVendor($id);
    }
}
