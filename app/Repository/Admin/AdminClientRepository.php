<?php

namespace App\Repository\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\DTO\Admin\AdminEditClientDTO;
use App\Interface\IRepository\Admin\IAdminClientRepository;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class AdminClientRepository implements IAdminClientRepository
{
    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }
    public function createClient(AdminClientDTO $data)
    {

        return $this->clientModel::create([
            "businessname" => $data->businessname,
            "region" => $data->region,
            "city" => $data->city,
            "state" => $data->state,
            "address" => $data->address,
            "email" => $data->email,
            "pin" => Hash::make($data->pin),
            "phone_number" => $data->phone_number,
        ]);
    }

    public function getSingleClient($id)
    {
        return $this->clientModel::with('vendors')->where('id', $id)->get();
    }

    public function updateClient(AdminEditClientDTO $data)
    {
        $client = $this->clientModel::find($data->id);

        $client->businessname = $data->businessname ?? $client->businessname;
        $client->region = $data->region ?? $client->region;
        $client->city = $data->city ?? $client->city;
        $client->state = $data->state ?? $client->state;
        $client->address = $data->address ?? $client->address;
        $client->email = $data->email ?? $client->email;
        $client->phone_number = $data->phone_number ?? $client->phone_number;

        return $client->save();
    }

    public function deleteClient($id)
    {
        return $this->clientModel::find($id)->delete();
    }

    public function getAllClients()
    {
        return $this->clientModel::with('vendors')->get();
    }
}
