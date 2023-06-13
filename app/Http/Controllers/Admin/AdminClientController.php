<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\DTO\Admin\AdminEditClientDTO;
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

            $data = new AdminClientDTO(...$request->except(['api_id', 'api_key']));

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
            return $this->success('retrieved successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function updateClient(Request $request, $id)
    {
        try {
            $data = new AdminEditClientDTO($id, ...$request->except(['api_id', 'api_key']));
            $result = $this->adminClientService->updateClient($data);
            return $this->success('updated successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleteClient($id)
    {
        try {
            $result = $this->adminClientService->deleteClient($id);
            return $this->success('deleted Client successfully', $result, 200);
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
