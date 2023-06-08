<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IService\Admin\IAdminAuthService;
use Validator;

class AdminAuthService implements IAdminAuthService
{

    public function __construct(private IAdminAuthRepository $adminAuthRepository){
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

        return $adminAuthRepository->login($validator->validated());
    }

    public function changePassword()
    {}

    public function forgotPassword()
    {}

    public function resetPassword()
    {}
}
