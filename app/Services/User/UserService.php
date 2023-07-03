<?php 
namespace App\Services\User;


use Validator;
use App\DTO\User\EditUserDTO;
use App\DTO\User\CreateUserDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IService\User\IUserService;
use App\Interface\IRepository\User\IUserRepository;

class UserService implements IUserService{

    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create_users(CreateUserDTO $data){
        $validator = Validator::make((array) $data,[
          "firstName" => 'required',
          "lastName"=> 'required',
          "email"=> "unique:users|email",
          "username"=>"required|unique:users",
          "phone_number"=>"required|unique:users|min:11",
          "password"=>"required|min:6"
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->userRepository->create_users($data);

    }

    public function getAllUsers(){}

    public function editUsers(EditUserDTO $data){}

    public function deleteUsers($id){}

    public function filterUsers(){}

    public function searchUsers(){}

    public function getSingleUser($id){}

    public function forgetPassword(){}

    public function resetPassword(){}

    public function login(){}

    public function changePassword(){}

    public function verify_user(){}
}