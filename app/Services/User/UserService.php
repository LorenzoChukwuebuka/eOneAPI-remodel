<?php
namespace App\Services\User;

use App\Custom\MailSender;
use App\DTO\OTP\CreateOTPDTO;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\DTO\User\SearchUserDTO;
use App\DTO\User\UserForgetPasswordDTO;
use App\DTO\User\UserLoginDTO;
use App\DTO\User\UserResetPasswordDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\User\IUserRepository;
use App\Interface\IService\IOTPService;
use App\Interface\IService\User\IUserService;
use Illuminate\Support\Str;
use Validator;

class UserService implements IUserService
{

    public function __construct(IUserRepository $userRepository, IOTPService $otpService)
    {
        $this->userRepository = $userRepository;
        $this->otpService = $otpService;
    }

    public function create_users(CreateUserDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "firstName" => 'required',
            "lastName" => 'required',
            "email" => "unique:users|email",
            "username" => "required|unique:users",
            "phone_number" => "required|unique:users|min:11",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        #send otp to user

        $token = Str::random(7);

        $createuser = $this->userRepository->create_users($data);

        $otpData = new CreateOTPDTO($createuser->id, $token);

        $this->otpService->createOtp($otpData);

        MailSender::verifyUserAccount($data->email, $token, $data->username);

        return "success";

    }

    public function getAllUsers()
    {
        $result = $this->userRepository->getAllUsers();

        if ($result->count() == 0) {
            throw new \Exception("No records found");

        }

        return $result;
    }

    public function editUsers(EditUserDTO $data)
    {
        return $this->userRepository->editUsers($data);
    }

    public function deleteUsers($id)
    {
        return $this->userRepository->deleteUsers($id);
    }

    public function filterUsers()
    {}

    public function searchUsers(SearchUserDTO $data)
    {

        $result = $this->userRepository->searchUsers($data);

        if ($result->count() == 0) {
            throw new \Error("No records found");
        }

        return $result;
    }

    public function getSingleUser($id)
    {
        $result = $this->userRepository->getSingleUser($id);

        if ($result == null) {
            throw new \Exception("No records found");

        }

        return $result;
    }

    public function forgetPassword(UserForgetPasswordDTO $data)
    {

    }

    public function resetPassword(UserResetPasswordDTO $data)
    {}

    public function login(UserLoginDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "username" => "required|exists:users",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->userRepository->login($data);
    }

    public function changePassword()
    {}

    public function verify_user()
    {}
}
