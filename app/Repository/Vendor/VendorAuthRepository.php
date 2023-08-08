<?php

namespace App\Repository\Vendor;

use App\DTO\Vendor\VendorForgetPasswordDTO;
use App\DTO\Vendor\VendorLoginDTO;
use App\DTO\Vendor\VendorResetPasswordDTO;
use App\DTO\Vendor\VerifyVendorDTO;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorAuthRepository implements IVendorAuthRepository
{
    public function __construct(Vendor $vendorModel)
    {
        $this->vendorModel = $vendorModel;
    }

    public function login(VendorLoginDTO $data)
    {
        $vendor = $this->vendorModel::where('username', $data->username)->first();
        #compare passwords

        $comparePasswords = \password_verify($data->password, $vendor->password);

        if (!$comparePasswords) {
            throw new \Exception("Password does not match", 1);
        }
        $token = $vendor->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'vendor',
            'token' => $token,
            'data' => $vendor,
        ];
    }
    public function changePassword()
    {

    }
    public function forgotPassword(VendorForgetPasswordDTO $data)
    {
        $getVendorName = $this->vendorModel->where('email', $data->email)->first();

        //insert into password reset db
        DB::table('password_resets')->insert([
            'email' => $data->email,
            'token' => $data->token,
            'created_at' => Carbon::now(),
        ]);

        return $getVendorName->business_name;

    }
    public function resetPassword(VendorResetPasswordDTO $data)
    {
        $selectedRows = DB::table('password_resets')
            ->select('email')
            ->where('token', '=', $data->otp)
            ->get();

        if ($selectedRows->count() == 0) {
            throw new \Exception("Invalid OTP");
        }

        //   $selectedRows[0]->email;
        $vendId = $this->vendorModel::where('email', $selectedRows[0]->email)->first();

        #update the password
        $vendId->update([
            'password' => Hash::make($data->password),
        ]);
        #delete the token
        return DB::statement("DELETE FROM password_resets WHERE email = ? AND token = ? ", [$selectedRows[0]->email, $data->otp]);

    }

    public function verifyVendor(VerifyVendorDTO $data)
    {
        $vendor = $this->vendorModel->find($data->user_id);

        $vendor->email_verified_at = Carbon::now();

        return $vendor->save();

    }
}
