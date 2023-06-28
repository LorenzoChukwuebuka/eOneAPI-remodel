<?php

namespace App\Http\Controllers\Client;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\DTO\Vendor\EditVendorDTO;
use App\DTO\Vendor\CreateVendorDTO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomValidationException;
use App\Interface\IService\Client\IClientVendorService;

class ClientVendorController extends Controller
{
    use ApiResponse;

    public function __construct(IClientVendorService $clientVendorService)
    {
        $this->clientVendorService = $clientVendorService;
    }
    public function createVendor(Request $request)
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

            $data = new CreateVendorDTO(
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

            $result = $this->clientVendorService->createVendor($data);

            return $this->success('vendor created successfully', $result, 201);

        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getSingleVendor($id)
    {
        try {
            $result = $this->clientVendorService->getSingleVendor($id);

            return $this->success('vendor listed', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function getAllVendorsForAParticularClient()
    {
        try {
            $id = auth()->user()->id;

            $result = $this->clientVendorService->getAllVendorsForAParticularClient($id);
            return $this->success('vendors listed');
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    // public function getAllVendors()
    // {
    //     try {
    //         //code...
    //     } catch (\Throwable $th) {
    //         return $this->fail($th->getMessage());
    //     }
    // }

    public function updateVendors(Request $request, $id)
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

            $data = new EditVendorDTO(
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

            $result = $this->clientService->updateVendors($data);

            return $this->success('updated vendors', $result,200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleteVendors($id)
    {
        try {
            $result = $this->clientService->deleteVendors($id);
            return $this->success('vendor deleted successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function filterVendor()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
