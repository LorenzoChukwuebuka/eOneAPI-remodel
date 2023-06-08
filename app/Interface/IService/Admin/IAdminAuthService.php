<?php

namespace App\Interface\IService\Admin;

use App\DTO\Admin\AdminAuthDTO;

interface IAdminAuthService
{
    public function login(AdminAuthDTO $data);
    public function changePassword();
    public function forgotPassword();
    public function resetPassword();
}
