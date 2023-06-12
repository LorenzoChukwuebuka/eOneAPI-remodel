<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\AdminCreateVendorDTO;
use App\DTO\Admin\AdminEditVendorDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Admin\IAdminVendorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    use ApiResponse;
    public function __construct(private IAdminVendorService $adminVendorService)
    {
        $this->adminVendorService = $adminVendorService;
    }
    public function createVendor(Request $request)
    {
        try {
            $data = new AdminCreateVendorDTO(...$request->all());
            $result = $this->adminVendorService->createVendor($data);
            return $this->success('create vendor successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getAllVendors()
    {
        try {
            $result = $this->adminVendorService->getAllVendors();
            return $this->success('vendors retrieved', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getSingleVendor($id)
    {
        try {
            $result = $this->adminVendorService->getSingleVendor($id);
            return $this->success('vendor retrieved', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function updateVendor(Request $request, $id)
    {
        try {

            $data = new AdminEditVendorDTO($id, ...$request->all());
            $result = $this->adminVendorService->updateVendor($data);
            return $this->success('vendor updated successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleteVendor($id)
    {
        try {
            return $this->success('deleted successfully', $this->adminVendorService->deleteVendor($id), 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

}
