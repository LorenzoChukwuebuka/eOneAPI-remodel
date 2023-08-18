<?php

namespace App\Repository\Transactions;

use App\Interface\IRepository\Vendor\IVendorTransactionRepository;
use App\Models\VendorTransaction;

class VendorTransactionRepository implements IVendorTransactionRepository
{
    public function __construct(VendorTransaction $vendorTransactionModel)
    {
        $this->vendorTransactionModel = $vendorTransactionModel;
    }
    public function create_vendor_transaction(object $data)
    {
        return $this->vendorTransactionModel::create([
            "vendor_id" => $data->vendor_id,
            "amount" => $data->amount,
            "transaction_type" => $data->transaction_type,
            "transaction_reference" => $data->transaction_reference,
            "card_transaction_id" => $data->card_transaction_id,
            "status" => $data->status,
            "meta_data" => $data->meta_data,
        ]);
    }
    public function find_transaction($id)
    {
        return $this->vendorTransactionModel::find($id);
    }
}
