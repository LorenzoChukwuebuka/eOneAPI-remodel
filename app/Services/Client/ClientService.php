<?php

namespace App\Services\Client;

use Validator;
use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\DTO\Client\ClientForgetPasswordDTO;
use App\Interface\IService\Client\IClientService;
use App\Interface\IRepository\Client\IClientRepository;

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

        return $this->clientRepository->loginClient($data);

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

    public function resetClientPin(ClientResetPasswordDTO $data){
        
    }

}
