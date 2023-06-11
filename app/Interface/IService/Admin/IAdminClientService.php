<?php

namespace App\Interface\IService\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\DTO\Admin\AdminEditClientDTO;

interface IAdminClientService
{
    public function createClient(AdminClientDTO $data);

    public function getSingleClient($id);

    public function updateClient(AdminEditClientDTO $data);

    public function deleteClient($id);

    public function getAllClients();
}
