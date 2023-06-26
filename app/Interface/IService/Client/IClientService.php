<?php 

namespace App\Interface\IService\Client;

use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\DTO\Client\ClientForgetPasswordDTO;

interface IClientService{
    public function loginClient(ClientLoginDTO $data);
    public function clientForgetPin(ClientForgetPasswordDTO $data);
    public function resetClientPin(ClientResetPasswordDTO $data);
}