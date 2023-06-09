<?php

namespace App\Interface\IRepository\Admin;

use App\DTO\Admin\AdminClientDTO;

interface IAdminClientRepository
{
    public function createClient(AdminClientDTO $data);

    public function getSingleClient($id);

    public function updateClient($id);

    public function deleteClient($id);

    public function getAllClients();
}
