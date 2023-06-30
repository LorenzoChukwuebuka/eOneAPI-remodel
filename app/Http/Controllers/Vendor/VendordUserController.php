<?php

namespace App\Http\Controllers\Vendor;

use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Vendor\IVendorUserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VendordUserController extends Controller
{
    use ApiResponse;

    public function __construct(IVendorUserService $vendorUserService)
    {
        $this->vendorUserService = $vendorUserService;
    }

    public function create_users(Request $request)
    {
        try {
            $data = new CreateUserDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->vendorUserService->create_users($data);
            return $this->success('user created successfully', $result, 201);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getAllUsers()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getAllUsersForAParticularVendor()
    {
        try {

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function editUsers(Request $request, $id)
    {
        try {
            $data = new EditUserDTO($id, ...$request->except(["api_id", "api_key"]));
            $result = $this->vendorUserService->editUsers($data);
            return $this->success('users edited successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleteUsers($id)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function filterUsers()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function searchUsers(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
