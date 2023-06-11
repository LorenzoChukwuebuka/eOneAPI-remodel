<?php

namespace App\Interface\IRepository\Admin;

use App\DTO\Admin\AdminClientDTO;
use App\DTO\Admin\AdminEditClientDTO;

interface IAdminClientRepository
{
    public function createClient(AdminClientDTO $data);

    public function getSingleClient($id);

    public function updateClient(AdminEditClientDTO $data);

    public function deleteClient($id);

    public function getAllClients();
}
