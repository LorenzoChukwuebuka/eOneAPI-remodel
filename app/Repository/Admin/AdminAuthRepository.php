<?php

namespace App\Repository\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\Interface\IRepository\Admin\IAdminAuthRepository;
use App\Models\Admin;

class AdminAuthRepository implements IAdminAuthRepository
{
    public function login(AdminAuthDTO $data)
    {
        $admin = Admin::where('email', $data->email)->first();
        $token = $admin->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'admin',
            'token' => $token,
            'data' => $admin,
        ];
    }
    public function changePassword()
    {}
    public function forgotPassword()
    {}
    public function resetPassword()
    {}
}
