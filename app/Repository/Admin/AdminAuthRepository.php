<?php

namespace App\Repository\Admin;

use App\Interface\IRepository\Admin\IAdminAuthRepository;

class AdminAuthRepository implements IAdminAuthRepository
{
    public function login(AdminAuthDTO $data)
    {
        return $data;
    }
    public function changePassword()
    {}
    public function forgotPassword()
    {}
    public function resetPassword()
    {}
}
