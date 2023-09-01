<?php

namespace App\Repository\Client;

use App\DTO\Client\ClientForgetPasswordDTO;
use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\Interface\IRepository\Client\IClientRepository;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientRepository implements IClientRepository
{
    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }
    public function loginClient(ClientLoginDTO $data)
    {
        $client = $this->clientModel::where('email', $data->email)->first();

        if (!$client) {
            throw new \Exception("No record with this email found", 1);

        }
        #compare passwords

        $comparePasswords = \password_verify($data->pin, $client->pin);

        if (!$comparePasswords) {
            throw new \Exception("Pin does not match", 1);
        }
        $token = $client->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'client',
            'token' => $token,
            'data' => $client,
        ];
    }

    public function clientForgetPin(ClientForgetPasswordDTO $data)
    {
        $getVendorName = $this->clientModel->where('email', $data->email)->first();

        //insert into password reset db
        DB::table('password_resets')->insert([
            'email' => $data->email,
            'token' => $data->token,
            'created_at' => Carbon::now(),
        ]);

    }

    public function resetClientPin(ClientResetPasswordDTO $data)
    {
        $selectedRows = DB::table('password_resets')
            ->select('email')
            ->where('token', '=', $data->otp)
            ->get();

        if ($selectedRows->count() == 0) {
            throw new \Exception("Invalid OTP");
        }

        //   $selectedRows[0]->email;
        $clientId = $this->clientModel::where('email', $selectedRows[0]->email)->first();

        #update the password
        $clientId->update([
            'password' => Hash::make($data->pin),
        ]);
        #delete the token
        return DB::statement("DELETE FROM password_resets WHERE email = ? AND token = ? ", [$selectedRows[0]->email, $data->otp]);
    }

}
