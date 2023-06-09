<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Admin\IAdminClientService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{

    use ApiResponse;

    public function __construct(IAdminClientService $adminClientservice)
    {
        $this->adminClientService = $adminClientservice;
    }
    public function createClient(Request $request)
    {
        try {

            $data = new AdminClientDTO(...$request->all());

            $result = $this->adminClientService->createClient($data);

            return $this->success('created client successfully', $result, 200);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getSingleClient($id)
    {
        try {
            $result = $this->adminClientService->getSingleClient($id);
            return $this->success('retrieved successfully', $result,200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function updateClient(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteClient(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getAllClients(Request $request)
    {
        try {
            $result = $this->adminClientService->getAllClients();
            return $this->success("retrieved all clients successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
