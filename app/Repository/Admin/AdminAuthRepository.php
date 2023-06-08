<?php

namespace App\Repository\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\DTO\Admin\AdminAuthDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\DTO\Admin\AdminResetPasswordDTO;
use App\DTO\Admin\AdminForgetPasswordDTO;
use App\Interface\IRepository\Admin\IAdminAuthRepository;

class AdminAuthRepository implements IAdminAuthRepository
{
    public function login(AdminAuthDTO $data)
    {
        $admin = Admin::where('email', $data->email)->first();
        $token = $admin->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'admin',
            'token' => $token,
            'data' => $admin,
        ];
    }
    public function changePassword()
    {}
    public function forgotPassword(AdminForgetPasswordDTO $data)
    {
        $token = Str::random(6);
        //insert into password reset db
        return DB::table('password_resets')->insert([
            'email' => $data->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

    }
    public function resetPassword(AdminResetPasswordDTO $data)
    {
      return   $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $data->email,
                'token' => $data->token,
            ])
            ->first();
        $user = Admin::where('email', $data->email)->update(['password' => Hash::make($data->password)]);
        DB::table('password_resets')->where(['email' => $data->email])->delete();

    }
}
