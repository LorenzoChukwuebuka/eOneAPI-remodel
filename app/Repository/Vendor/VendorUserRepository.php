<?php

namespace App\Repository\Vendor;

use App\DTO\User\EditUserDTO;
use App\DTO\User\CreateUserDTO;
use App\Interface\IRepository\Vendor\IVendorUserRepository;

class VendorUserRepository implements IVendorUserRepository
{
    public function create_users(CreateUserDTO $data)
    {}

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
