<?php

namespace App\Repository\Client;

use App\DTO\Client\ClientForgetPasswordDTO;
use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\Interface\IRepository\Client\IClientRepository;
use App\Models\Client;

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
        #generate token and store in otp

    }

    public function resetClientPin(ClientResetPasswordDTO $data)
    {

    }

}
