<?php

namespace App\Interface\IRepository\Vendor;

interface IVendorTransactionRepository
{
    public function create_vendor_transaction(object $data);
    public function find_transaction($id);
}
