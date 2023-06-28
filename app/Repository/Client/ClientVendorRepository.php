<?php

namespace App\Repository\Client;

use App\DTO\Vendor\CreateVendorDTO;
use App\DTO\Vendor\EditVendorDTO;
use App\Interface\IRepository\Client\IClientVendorRepository;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class ClientVendorRepository implements IClientVendorRepository
{
    public function __construct(Vendor $vendorModel)
    {
        $this->vendorModel = $vendorModel;
    }
    public function createVendor(CreateVendorDTO $data)
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
        return $this->vendorModel::with('client')->where('id', $id)->first();
    }

    public function getAllVendorsForAParticularClient(int $id)
    {
        return $this->vendorModel::with('client')->where('client_id', $id);
    }

    public function getAllVendors()
    {
        //  return $this->vendorModel::where('client_id', auth()->user()->id);
    }

    public function updateVendors(EditVendorDTO $data)
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

    public function deleteVendors($id)
    {
        return $this->vendorModel::find($id)->delete();
    }

    public function filterVendor()
    {}
}
