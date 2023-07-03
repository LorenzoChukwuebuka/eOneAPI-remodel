<?php

namespace App\Http\Controllers\User;

use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\User\IUserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ApiResponse;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function create_user(Request $request)
    {
        try {
            $data = new CreateUserDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->userService->create_users($data);
            return $this->success('user created successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function forgetPassword()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function verify_user()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPassword()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function login()
    {
        try {
            //code...
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
