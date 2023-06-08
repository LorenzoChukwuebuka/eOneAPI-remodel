<?php

namespace App\Interface\IService\Admin;

interface IAdminClientService
{
    public function createClient();

    public function getSingleClient();

    public function updateClient();

    public function deleteClient();

    public function getAllClients();
}
