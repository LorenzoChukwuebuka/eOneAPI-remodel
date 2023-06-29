<?php

namespace App\Http\Controllers\Vendor;

use App\DTO\Vendor\VendorLoginDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Vendor\IVendorAuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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

    public function forgetPin()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPin()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function changePin()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
