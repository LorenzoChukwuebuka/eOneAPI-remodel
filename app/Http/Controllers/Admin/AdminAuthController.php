<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\AdminAuthDTO;
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
            $data = new AdminAuthDTO(...$request->all());
            $result = $this->adminAuthService->login($data);
            return $this->success("success", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

   
}
