<?php

namespace App\Http\Controllers\User;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\DTO\User\SearchUserDTO;
use App\DTO\User\UserLoginDTO;
use App\DTO\User\VerifyUserDTO;
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

    public function get_all_users()
    {
        try {
            $result = $this->userService->getAllUsers();
            return $this->success("users retrieved successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function get_single_user($id)
    {
        try {
            $result = $this->userService->getSingleUser($id);
            return $this->success("user retrieved successfull", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function edit_user(Request $request, $id)
    {
        try {
            $data = new EditUserDTO($id, ...$request->except(["api_id", "api_key"]));
            $result = $this->userService->editUsers($data);
            return $this->success("user edited successful", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function delete_user($id)
    {
        try {
            $result = $this->userService->deleteUsers($id);
            return $this->success("user deleted successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function search_users(Request $request)
    {
        try {
            $data = new SearchUserDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->userService->searchUsers($data);
            return $this->success('users found', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function verify_user(Request $request)
    {
        try {
            $data = new VerifyUserDTO(...$request->except(['api_id', 'api_key']));

            $result = $this->userService->verify_user($data);

            return $this->success('user verified successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $data = new UserLoginDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->userService->login($data);
            return $this->success('user logged in successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

}
