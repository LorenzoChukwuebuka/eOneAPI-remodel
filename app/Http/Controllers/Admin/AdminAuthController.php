<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\AdminAuthDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;
use App\DTO\Admin\AdminResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Admin\IAdminAuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    use ApiResponse;

    public function __construct(private IAdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }

    public function login(Request $request)
    {
        try {
            $request->except('api_key');
            $data = new AdminAuthDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->adminAuthService->login($data);
            return $this->success("login success", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $data = new AdminForgetPasswordDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->adminAuthService->forgotPassword($data);
            return $this->success("email sent successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $data = new AdminResetPasswordDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->adminAuthService->resetPassword($data);
            return $this->success("password reset successful", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            return $request->all();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
