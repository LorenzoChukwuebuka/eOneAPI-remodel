<?php

namespace App\Services\Client;

use Validator;
use App\Custom\MailSender;
use Illuminate\Support\Str;
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

        $token = Str::random(7);

        $data->token = $token;

        $repo = $this->clientRepository->clientForgetPin($data);

        #send mail to client

        MailSender::clientForgetPassword();

    }

    public function resetClientPin(ClientResetPasswordDTO $data)
    {

    }

}
