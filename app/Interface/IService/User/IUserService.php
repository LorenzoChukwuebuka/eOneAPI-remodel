<?php

namespace App\Interface\IService\User;

use App\DTO\User\EditUserDTO;
use App\DTO\User\UserLoginDTO;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\SearchUserDTO;
use App\DTO\User\UserResetPasswordDTO;
use App\DTO\User\UserForgetPasswordDTO;

interface IUserService
{
    public function create_users(CreateUserDTO $data);
    public function getAllUsers();
    public function editUsers(EditUserDTO $data);
    public function deleteUsers($id);
    public function filterUsers();
    public function searchUsers(SearchUserDTO $data);
    public function getSingleUser($id);
    public function forgetPassword(UserForgetPasswordDTO $data);
    public function resetPassword(UserResetPasswordDTO $data);
    public function login(UserLoginDTO $data);
    public function changePassword();
    public function verify_user();
}
