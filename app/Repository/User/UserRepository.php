<?php

namespace App\Repository\User;

use App\DTO\User\CreateUpdateTransactionPinDTO;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\EditUserDTO;
use App\DTO\User\SearchUserDTO;
use App\DTO\User\UserForgetPasswordDTO;
use App\DTO\User\UserLoginDTO;
use App\DTO\User\UserResetPasswordDTO;
use App\DTO\User\VerifyUserDTO;
use App\Interface\IRepository\User\IUserRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function create_users(CreateUserDTO $data)
    {
        return $this->userModel::create([
            "firstname" => $data->firstName,
            "lastname" => $data->lastName,
            "password" => Hash::make($data->password),
            "phone_number" => $data->phone_number,
            "email" => $data->email,
            "username" => $data->username,

        ]);
    }

    public function getAllUsers()
    {
        return $this->userModel::with('card')->get();
    }

    public function editUsers(EditUserDTO $data)
    {
        $user = $this->userModel::find($data->id);

        $user->firstname = $data->firstName ?? $user->firstname;
        $user->lastname = $data->lastName ?? $user->lastname;
        $user->email = $data->email ?? $user->email;
        $user->username = $data->username ?? $user->username;
        $user->phone_number = $data->phone_number ?? $user->phone_number;

        $user->save();

    }

    public function deleteUsers($id)
    {
        return $this->userModel::find($id)->delete();
    }

    public function filterUsers()
    {}

    public function searchUsers(SearchUserDTO $data)
    {
        return $this->userModel::where('firstname', 'LIKE', "%{$data->keyword}%")->orWhere('lastname', 'LIKE', "%{$data->keyword}%")->orWhere('username', 'LIKE', "%{$data->keyword}%")->latest()->get();
    }

    public function getSingleUser($id)
    {
        return $this->userModel::with('card')->where('id', $id)->first();
    }

    public function forgetPassword(UserForgetPasswordDTO $data)
    {
        $getUserName = $this->userModel->where('email', $data->email)->first();

        //insert into password reset db
        DB::table('password_resets')->insert([
            'email' => $data->email,
            'token' => $data->token,
            'created_at' => Carbon::now(),
        ]);

        return $getUserName->username;
    }

    public function resetPassword(UserResetPasswordDTO $data)
    {
        $selectedRows = DB::table('password_resets')
            ->select('email')
            ->where('token', '=', $data->otp)
            ->get();

        if ($selectedRows->count() == 0) {
            throw new \Exception("Invalid OTP");
        }

        //   $selectedRows[0]->email;
        $userId = $this->userModel::where('email', $selectedRows[0]->email)->first();

        #update the password
        $userId->update([
            'password' => Hash::make($data->password),
        ]);
        #delete the token
        return DB::statement("DELETE FROM password_resets WHERE email = ? AND token = ? ", [$selectedRows[0]->email, $data->otp]);
    }

    public function login(UserLoginDTO $data)
    {
        $user = $this->userModel::where('username', $data->username)->first();

        if (!$user) {
            throw new \Exception("User not found", 1);
        }

        $comparePasswords = \password_verify($data->password, $user->password);

        if (!$comparePasswords) {
            throw new \Exception("Password does not match", 1);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'user',
            'token' => $token,
            'data' => $user,
        ];
    }

    public function changePassword()
    {}

    public function verify_user(VerifyUserDTO $data)
    {
        $user = $this->userModel->find($data->user_id);

        $user->email_verified_at = Carbon::now();

        return $user->save();

    }

    public function createUpdateTransactionPin(CreateUpdateTransactionPinDTO $data)
    {
        return $this->userModel::updateOrCreate(['id' => auth()->user()->id],
            [
                "transaction_pin" => Hash::make($data->transaction_pin),
            ]);
    }

}
