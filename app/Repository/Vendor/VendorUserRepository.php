<?php

namespace App\Repository\Vendor;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\Interface\IRepository\Vendor\IVendorUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorUserRepository implements IVendorUserRepository
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
            "phone_number" => $data->phone_number,
            "email" => $data->email,
            "username" => $data->username,
            "password" => Hash::make($data->password),
        ]);
    }

    public function getAllUsers()
    {}

    public function getAllUsersForAParticularVendor($id)
    {
        return $this->userModel::with('vendor')->where('vendor_id', $id)->latest()->get();
    }

    public function editUsers(EditUserDTO $data)
    {
        $user = $this->userModel::find($data->id);

        $user->firstname = $data->firstName ?? $user->firstname;
        $user->lastname = $data->lastName ?? $user->lastname;
        $user->phone_number = $data->phone_number ?? $user->phone_number;
        $user->email = $data->email ?? $user->email;
        $user->username = $data->username ?? $user->username;

        $user->save();
    }

    public function deleteUsers($id)
    {
        return $this->userModel::find($id)->delete();
    }

    public function getSingleUser($id)
    {
        return $this->userModel::with('vendor')->where('id', $id)->first();
    }

    public function filterUsers()
    {

    }

    public function searchUsers()
    {}
}
