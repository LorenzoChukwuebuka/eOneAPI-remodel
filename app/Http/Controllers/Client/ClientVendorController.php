<?php

namespace App\Http\Controllers\Client;

use App\DTO\Vendor\CreateVendorDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Client\IClientVendorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ClientVendorController extends Controller
{
    use ApiResponse;

    public function __construct(IClientVendorService $clientVendorService)
    {
        $this->$clientVendorService = $clientVendorService;
    }
    public function createVendor(Request $request)
    {
        try {
            $data = new CreateVendorDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->clientVendorService->createVendor($data);

            return $this->success('vendor created successfully', $result, 201);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getSingleVendor($id)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAllVendorsForAParticularClient()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAllVendors()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateVendors()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteVendors()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function filterVendor()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
