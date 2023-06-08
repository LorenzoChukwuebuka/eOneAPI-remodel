<?php
namespace App\Interface\IRepository\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;
use App\DTO\Admin\AdminResetPasswordDTO;

interface IAdminAuthRepository
{
    public function login(AdminAuthDTO $data);
    public function changePassword();
    public function forgotPassword(AdminForgetPasswordDTO $data);
    public function resetPassword(AdminResetPasswordDTO $data);
}
