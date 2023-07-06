<?php

namespace App\Services\Client;

use App\DTO\Client\ClientForgetPasswordDTO;
use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\Interface\IRepository\Client\IClientRepository;
use App\Interface\IService\Client\IClientService;
use Validator;

class ClientService implements IClientService
{
    public function __construct(IClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
    public function loginClient(ClientLoginDTO $data)
    {

        $validator = Validator::make((array) $data, [
            'email' => 'required|email',
            'pin' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $client = $this->clientRepository->loginClient($data);


        return $client;

    }

    public function clientForgetPin(ClientForgetPasswordDTO $data)
    {
        $validator = Validator::make((array) $data, [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        #send mail to client

        return $this->clientRepository->clientForgetPin($data);
    }

    public function resetClientPin(ClientResetPasswordDTO $data)
    {

    }

}
