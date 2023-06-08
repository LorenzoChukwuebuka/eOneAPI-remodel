<?php

namespace App\Repository\Admin;

use App\Models\Admin;
use App\DTO\Admin\AdminAuthDTO;
use App\DTO\Admin\AdminResetPasswordDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;
use App\Interface\IRepository\Admin\IAdminAuthRepository;

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
    public function forgotPassword(AdminForgetPasswordDTO $data)
    {}
    public function resetPassword(AdminResetPasswordDTO $data)
    {}
}
