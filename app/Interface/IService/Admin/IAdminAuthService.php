<?php

namespace App\Interface\IService\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\DTO\Admin\AdminResetPasswordDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;

interface IAdminAuthService
{
    public function login(AdminAuthDTO $data);
    public function changePassword();
    public function forgotPassword(AdminForgetPasswordDTO $data);
    public function resetPassword(AdminResetPasswordDTO $data);
}
