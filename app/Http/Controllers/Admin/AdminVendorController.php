<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTO\Admin\AdminEditVendorDTO;
use App\DTO\Admin\AdminCreateVendorDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IService\Admin\IAdminVendorService;

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
            // Assuming the file input name is 'logo'

            if ($request->hasFile('logo')) {
                $validator = Validator::make($request->all(), [
                    'logo' => 'required|file|mimes:jpeg,png|max:2048',
                ]);

                if ($validator->fails()) {
                    throw new CustomValidationException($validator);
                }

                $fileUrl = $request->logo->store('vendor', 'public');
            } else {
                $fileUrl = null;
            }

            $data = new AdminCreateVendorDTO(
                $request->input('client_id'),
                $request->input('category'),
                $request->input('business_name'),
                $request->input('region'),
                $request->input('state'),
                $request->input('city'),
                $request->input('address'),
                $request->input('email'),
                $request->input('phone_number'),
                $fileUrl, // Pass the file URL to the constructor
                $request->input('longitude'),
                $request->input('latitude'),
                $request->input('password')
            );

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

            if ($request->hasFile('logo')) {
                $validator = Validator::make($request->all(), [
                    'logo' => 'required|file|mimes:jpeg,png|max:2048',
                ]);

                if ($validator->fails()) {
                    throw new CustomValidationException($validator);
                }

                $fileUrl = $request->logo->store('vendor', 'public');
            } else {
                $fileUrl = null;
            }

            $data = new AdminEditVendorDTO(
                $id,
                $request->input('client_id'),
                $request->input('category'),
                $request->input('business_name'),
                $request->input('region'),
                $request->input('state'),
                $request->input('city'),
                $request->input('address'),
                $request->input('email'),
                $request->input('phone_number'),
                $fileUrl, // Pass the file URL to the constructor
                $request->input('longitude'),
                $request->input('latitude')
            );
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
