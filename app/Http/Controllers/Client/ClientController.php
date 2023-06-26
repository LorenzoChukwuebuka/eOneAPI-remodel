<?php

namespace App\Http\Controllers\Client;

use App\DTO\Client\ClientForgetPasswordDTO;
use App\DTO\Client\ClientLoginDTO;
use App\DTO\Client\ClientResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Client\IClientService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponse;

    public function __construct(IClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function loginClient(Request $request)
    {
        try {

            $data = new ClientLoginDTO(...$request->except(['api_id', 'api_key']));

            $result = $this->clientService->loginClient($data);

            return $this->success('logged in successfully', $result, 200);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function forgetPin(Request $request)
    {
        try {
            $data = new ClientForgetPasswordDTO(...$request->except(['api_id', 'api_key']));

            $result = $this->clientService->clientForgetPin($data);
            return $this->success('reset pin sms sent successfully', $result, 200);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resetPin(Request $request)
    {
        try {
            $data = new ClientResetPasswordDTO(...$request->except(['api_id', 'api_key']));
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

}
