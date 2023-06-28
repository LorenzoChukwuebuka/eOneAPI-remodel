<?php

namespace App\Services\Client;

use App\DTO\Vendor\CreateVendorDTO;
use App\DTO\Vendor\EditVendorDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Client\IClientVendorRepository;
use App\Interface\IService\Client\IClientVendorService;
use Validator;

class ClientVendorService implements IClientVendorService
{

    public function __construct(IClientVendorRepository $clientVendorRepository)
    {
        $this->clientVendorRepository = $clientVendorRepository;
    }
    public function createVendor(CreateVendorDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "client_id" => "required",
            "category" => [],
            "business_name" => "required",
            "region" => "required",
            "state" => "required",
            "city" => "required",
            "address" => "required",
            "email" => "email|required|unique:vendors",
            "longitude" => [],
            "latitude" => [],
            "password" => "required|min:6",
            "phone_number" => "required|min:11",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->clientVendorRepository->createVendor($data);

    }

    public function getSingleVendor($id)
    {
        $result = $this->clientVendorRepository->getSingleVendor($id);

        if ($result == null) {
            throw new \Exception ("No record found");
        }

        return $result;

    }

    public function getAllVendorsForAParticularClient(int $id)
    {
        $result = $this->clientVendorRepository->getAllVendorsForAParticularClient($id);

        if ($result->count() == 0) {
            throw new \Exception ("No result found");
        }

        return $result;
    }

    public function getAllVendors()
    {}

    public function updateVendors(EditVendorDTO $data)
    {
        return $this->updateVendors($data);
    }

    public function deleteVendors($id)
    {
        return $this->deleteVendors($id);
    }

    public function filterVendor()
    {}
}
