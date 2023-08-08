<?php

namespace App\Http\Controllers\Vendor;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VerifyVendorDTO;
use App\Http\Controllers\Controller;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\Interface\IService\Vendor\IVendorAuthService;

class VendordAuthController extends Controller
{
    use ApiResponse;

    public function __construct(IVendorAuthService $vendorAuthService)
    {
        $this->vendorAuthService = $vendorAuthService;

    }
    public function login(Request $request)
    {
        try {
            $data = new VendorLoginDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->vendorAuthService->login($data);
            return $this->success('vendor logged in successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function verifyVendor(Request $request)
    {
        try {
            $data = new VerifyVendorDTO(...$request->except(["api_id", "api_key"]));

            $result = $this->vendorAuthService->verifyVendor($data);

            return $this->success('account verified successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            $data = new VendorForgetPasswordDTO(...$request->except(['api_id', 'api_key']));

            $result = $this->vendorAuthService->forgotPassword($data);
            return $this->success('email successfully', $result, 200);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $data = new VendorResetPasswordDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->vendorAuthService->resetPassword($data);
            return $this->success('password reset successful', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function changePassword()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
