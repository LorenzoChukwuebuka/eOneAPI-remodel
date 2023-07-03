<?php

namespace App\Repository\User;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\Interface\IRepository\User\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function create_users(CreateUserDTO $data)
    {
        return $this->userModel::create([
            "firstname" => $data->firstName,
            "lastname" => $data->lastName,
            "password" => Hash::make($data->password),
            "phone_number" => $data->phone_number,
            "email" => $data->email,
            "username" => $data->username,

        ]);
    }

    public function getAllUsers()
    {
        return $this->userModel::with('card')->get();
    }

    public function editUsers(EditUserDTO $data)
    {
        $user = $this->userModel::find($id);

        $user->firstname = $data->firstName ?? $user->firstname;
        $user->lastname = $data->lastName ?? $user->lastname;
        $user->email = $data->email ?? $user->email;
        $user->username = $data->username ?? $user->username;
        $user->phone_number = $data->phone_number ?? $user->phone_number;

        $user->save();

    }

    public function deleteUsers($id)
    {
        return $this->userModel::find($id)->delete();
    }

    public function filterUsers()
    {}

    public function searchUsers()
    {}

    public function getSingleUser($id)
    {
        return $this->userModel::with('card')->where('id',$id)->first();
    }

    public function forgetPassword()
    {}

    public function resetPassword()
    {}

    public function login()
    {}

    public function changePassword()
    {}

    public function verify_user()
    {}
}
