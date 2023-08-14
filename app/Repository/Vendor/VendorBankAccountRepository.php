<?php

namespace App\Repository\Vendor;

use App\DTO\Vendor\CreateVendorBankAccountDTO;
use App\Interface\IRepository\Vendor\IVendorBankAccountRepository;
use App\Models\VendorBankAccount;

class VendorBankAccountRepository implements IVendorBankAccountRepository
{
    public function __construct(VendorBankAccount $vendorBankAccountModel)
    {
        $this->vendorBankAccountModel = $vendorBankAccountModel;
    }
    public function list_banks()
    {}
    public function create_bank_account(CreateVendorBankAccountDTO $data)
    {
        return $this->vendorBankAccountModel::create([
            "vendor_id" => $data->vendor_id,
            "account_name" => $data->account_name,
            "account_number" => $data->account_number,
            "bank_name" => $data->bank_name,
            "bank_code" => $data->bank_code,
            "default_account" => $data->default_account,
            "account_type" => $data->account_type,
        ]);
    }
    public function delete_account($id)
    {
        return $this->vendorBankAccountModel::find($id)->delete();
    }
    public function list_accounts()
    {
        return $this->vendorBankAccountModel::with('vendor')->where('vendor_id', auth()->user()->id)->latest()->get();
    }
    public function list_accounts_for_a_vendor()
    {
        return $this->vendorBankAccountModel::with('vendor')->latest()->get();
    }
    public function get_account_by_id($id)
    {
        return $this->vendorBankAccountModel::find($id);
    }
}
