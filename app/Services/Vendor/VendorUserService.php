<?php

namespace App\Services\Vendor;

use App\DTO\User\EditUserDTO;
use App\DTO\User\CreateUserDTO;
use App\Interface\IService\Vendor\IVendorUserService;

class VendorUserService implements IVendorUserService{
    public function create_users(CreateUserDTO $data)
    {
        return $data;
    }

    public function getAllUsers()
    {}

    public function getAllUsersForAParticularVendor($id)
    {}

    public function editUsers(EditUserDTO $data)
    {}

    public function deleteUsers($id)
    {}

    public function filterUsers()
    {}

    public function searchUsers()
    {}
}