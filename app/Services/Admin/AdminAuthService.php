<?php

namespace App\Services\Admin;

use Validator;
use App\DTO\Admin\AdminAuthDTO;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomValidationException;
use Illuminate\Validation\ValidationException;
use App\Interface\IService\Admin\IAdminAuthService;
use App\Interface\IRepository\Admin\IAdminAuthRepository;

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

    public function forgotPassword()
    {}

    public function resetPassword()
    {}
}
