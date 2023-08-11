<?php

namespace App\Services\Vendor;

use App\Interface\IService\Vendor\IVendorBankAccountService;

class VendorBankAccountService implements IVendorBankAccountService
{
    public function list_banks()
    {}
    public function create_bank_account(CreateVendorBankAccountDTO $data)
    {}
    public function delete_account()
    {}
    public function list_accounts()
    {}
    public function list_accounts_for_a_vendor()
    {}
    public function get_account_by_id($id)
    {}
}
