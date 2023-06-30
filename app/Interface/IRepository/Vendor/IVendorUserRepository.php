<?php

namespace App\Interface\IRepository\Vendor;

use App\DTO\User\EditUserDTO;
use App\DTO\User\CreateUserDTO;

interface IVendorUserRepository
{
    public function create_users(CreateUserDTO $data) ;

    public function getAllUsers();

    public function getAllUsersForAParticularVendor($id);

    public function editUsers(EditUserDTO $data);

    public function deleteUsers($id);

    public function filterUsers();

    public function searchUsers();
}
