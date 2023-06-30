<?php

namespace App\Services\Vendor;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Vendor\IVendorUserRepository;
use App\Interface\IService\Vendor\IVendorUserService;
use Validator;

class VendorUserService implements IVendorUserService
{

    public function __construct(IVendorUserRepository $vendorUserRepository)
    {
        $this->vendorUserRepository = $vendorUserRepository;
    }

    public function create_users(CreateUserDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "firstName" => "required",
            "lastName" => "required",
            "username" => "required|unique:users",
            "email" => [],
            "phone_number" => "required|unique:users|min:11",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        #send message to user with otp for verification

        return $this->vendorUserRepository->create_users($data);

    }

    public function getAllUsers()
    {}

    public function getAllUsersForAParticularVendor($id)
    {
        $result = $this->vendorUserRepository->getAllUsersForAParticularVendor($id);

        if ($result->count() == 0) {
            throw new \Exception("No records found", 1);

        }

        return $result;
    }

    public function editUsers(EditUserDTO $data)
    {
        return $this->vendorUserRepository->editUsers($data);
    }

    public function deleteUsers($id)
    {
        return $this->vendorUserRepository->deleteUsers($id);
    }

    public function filterUsers()
    {}

    public function searchUsers()
    {}
}
