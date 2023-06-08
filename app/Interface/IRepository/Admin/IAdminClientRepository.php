<?php

namespace App\Interface\IRepository\Admin;

interface IAdminClientRepository
{
    public function createClient();

    public function getSingleClient();

    public function updateClient();

    public function deleteClient();

    public function getAllClients();
}
