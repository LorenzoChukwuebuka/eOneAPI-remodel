<?php

namespace App\Repository\Admin;

use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use App\DTO\Admin\AdminEditVendorDTO;
use App\DTO\Admin\AdminCreateVendorDTO;
use App\Interface\IRepository\Admin\IAdminVendorRepository;

class AdminVendorRepository implements IAdminVendorRepository
{
    public function __construct(Vendor $vendorModel)
    {
        $this->vendorModel = $vendorModel;
    }
    public function createVendor(AdminCreateVendorDTO $data)
    {
        return $this->vendorModel::create([
            "client_id" => $data->client_id,
            "category" => $data->category,
            "business_name" => $data->business_name,
            "region" => $data->region,
            "state" => $data->state,
            "city" => $data->city,
            "address" => $data->address,
            "email" => $data->email,
            "phone_number" => $data->phone_number,
            "longitude" => $data->longitude,
            "latitude" => $data->latitude,
            "password" => Hash::make($data->password),
        ]);
    }
    public function getSingleVendor($id)
    {
        return $this->vendorModel::where('id', $id)->get();
    }
    public function getAllVendors()
    {
        return $this->vendorModel::get();
    }
    public function updateVendor(AdminEditVendorDTO $data)
    {
        $vendor = $this->vendorModel::find($data->id);

        $vendor->client_id = $data->client_id ?? $vendor->client_id;
        $vendor->category = $data->category ?? $vendor->category;
        $vendor->business_name = $data->business_name ?? $vendor->business_name;
        $vendor->region = $data->region ?? $vendor->region;
        $vendor->state = $data->state ?? $vendor->state;
        $vendor->city = $data->city ?? $vendor->city;
        $vendor->address = $data->address ?? $vendor->address;
        $vendor->email = $data->email ?? $vendor->email;
        $vendor->phone_number = $data->phone_number ?? $vendor->phone_number;
        $vendor->longitude = $data->longitude ?? $vendor->longitude;
        $vendor->latitude = $data->latitude ?? $vendor->latitude;

        $vendor->save();
    }
    public function deleteVendor($id)
    {
        return $this->vendorModel::find($id)->delete();
    }
}
