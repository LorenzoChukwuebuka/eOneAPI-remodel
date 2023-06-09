<?php

namespace App\Repository\Admin;

use App\DTO\Admin\AdminClientDTO;
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
        return $this->clientModel->where('id', $id)->get();
    }

    public function updateClient($id)
    {
         $client = $this->clientModel::find($id);
    }

    public function deleteClient($id)
    {
        return $this->clientModel::find($id)->delete();
    }

    public function getAllClients()
    {
        return $this->clientModel->get();
    }
}
