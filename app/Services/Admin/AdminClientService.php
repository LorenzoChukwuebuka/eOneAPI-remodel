<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\DTO\Admin\AdminEditClientDTO;
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

        //   MailSender::verifyClientAccount($data->email,)

        return $this->adminClientRepository->createClient($data);
    }

    public function getSingleClient($id)
    {
        $result = $this->adminClientRepository->getSingleClient($id);

        if ($result->count() == 0) {
            throw new \Exception("No result found", 1);
        }

        return $result;
    }

    public function updateClient(AdminEditClientDTO $data)
    {
        return $this->adminClientRepository->updateClient($data);
    }

    public function deleteClient($id)
    {
        return $this->adminClientRepository->deleteClient($id);
    }

    public function getAllClients()
    {
        $result = $this->adminClientRepository->getAllClients();

        if ($result->count() == 0) {
            throw new \Exception("No result found", 1);
        }

        return $result;
    }
}
