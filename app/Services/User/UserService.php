<?php 

use App\DTO\User\EditUserDTO;
use App\DTO\User\CreateUserDTO;
use App\Interface\IService\User\IUserService;

class UserService implements IUserService{
    public function create_users(CreateUserDTO $data){}

    public function getAllUsers(){}

    public function editUsers(EditUserDTO $data){}

    public function deleteUsers($id){}

    public function filterUsers(){}

    public function searchUsers(){}

    public function getSingleUser($id){}

    public function forgetPassword(){}

    public function resetPassword(){}

    public function login(){}

    public function changePassword(){}
}