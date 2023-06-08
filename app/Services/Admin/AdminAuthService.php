<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;
use App\DTO\Admin\AdminResetPasswordDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Admin\IAdminAuthRepository;
use App\Interface\IService\Admin\IAdminAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class AdminAuthService implements IAdminAuthService
{

    public function __construct(private IAdminAuthRepository $adminAuthRepository)
    {
        $this->adminAuthRepository = $adminAuthRepository;
    }
    public function login(AdminAuthDTO $adminDTO)
    {
        $validator = Validator::make((array) $adminDTO, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $credentials = [
            'email' => $adminDTO->email,
            'password' => $adminDTO->password,
        ];

        if (!Auth::guard('admin')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password',
            ]);
        }

        return $this->adminAuthRepository->login($adminDTO);
    }

    public function changePassword()
    {}

    public function forgotPassword(AdminForgetPasswordDTO $data)
    {
        $validator = Validator::make((array) $data, [
            'email' => 'required|email|exists:admins',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->adminAuthRepository->forgotPassword($data);
    }

    public function resetPassword(AdminResetPasswordDTO $data)
    {
        $validator = Validator::make((array) $data, [
            'email' => 'required|email|exists:admins',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token'=>'required|exists:password_resets'
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->adminAuthRepository->resetPassword($data);
    }
}
