<?php

namespace App\Interface\IService\Admin;

use App\DTO\Admin\AdminClientDTO;

interface IAdminClientService
{
    public function createClient(AdminClientDTO $data);

    public function getSingleClient($id);

    public function updateClient($id);

    public function deleteClient($id);

    public function getAllClients();
}
