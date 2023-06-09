<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Admin\IAdminClientRepository;
use App\Interface\IService\Admin\IAdminClientService;
use Validator;

class AdminClientService implements IAdminClientService
{

    public function __construct(IAdminClientRepository $adminClientRepository)
    {
        $this->adminClientRepository = $adminClientRepository;
    }
    public function createClient(AdminClientDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "businessname" => 'required',
            "region" => 'required',
            "city" => 'required',
            "state" => 'required',
            "address" => 'required',
            "email" => 'email|unique:clients',
            "pin" => 'required|min:4|max:6',
            "phone_number" => [],
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->adminClientRepository->createClient($data);
    }

    public function getSingleClient($id)
    {
        return $this->adminClientRepository->getSingleClient($id);
    }

    public function updateClient($id)
    {}

    public function deleteClient($id)
    {}

    public function getAllClients()
    {
        return $this->adminClientRepository->getAllClients();
    }
}
