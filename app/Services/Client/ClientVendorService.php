<?php

namespace App\Services\Client;

use App\Custom\MailSender;
use App\DTO\OTP\CreateOTPDTO;
use App\DTO\Vendor\CreateVendorDTO;
use App\DTO\Vendor\EditVendorDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Client\IClientVendorRepository;
use App\Interface\IService\Client\IClientVendorService;
use App\Interface\IService\IOTPService;
use Illuminate\Support\Str;
use Validator;

class ClientVendorService implements IClientVendorService
{

    public function __construct(IClientVendorRepository $clientVendorRepository, IOTPService $otpService)
    {
        $this->clientVendorRepository = $clientVendorRepository;
        $this->otpService = $otpService;
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
            "username" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $token = Str::random(7);

        $vendor = $this->clientVendorRepository->createVendor($data);

        $otpData = new CreateOTPDTO($vendor->id, $token);

        $this->otpService->createOtp($otpData);

        MailSender::verifyVendorAccount($data->email, $token, $data->business_name);

        return "success";

    }

    public function getSingleVendor($id)
    {
        $result = $this->clientVendorRepository->getSingleVendor($id);

        if ($result == null) {
            throw new \Exception("No record found");
        }

        return $result;

    }

    public function getAllVendorsForAParticularClient(int $id)
    {
        $result = $this->clientVendorRepository->getAllVendorsForAParticularClient($id);

        if ($result->count() == 0) {
            throw new \Exception("No result found");
        }

        return $result;
    }

    public function getAllVendors()
    {}

    public function updateVendors(EditVendorDTO $data)
    {
        return $this->clientVendorRepository->updateVendors($data);
    }

    public function deleteVendors($id)
    {

        return $this->clientVendorRepository->deleteVendors($id);
    }

    public function filterVendor()
    {}
}
