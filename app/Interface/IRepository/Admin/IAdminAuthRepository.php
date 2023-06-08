<?php
namespace App\Interface\IRepository\Admin;

use App\DTO\Admin\AdminAuthDTO;

interface IAdminAuthRepository
{
   public function login(AdminAuthDTO $data);
   public function changePassword();
   public function forgotPassword();
   public function resetPassword();
}
