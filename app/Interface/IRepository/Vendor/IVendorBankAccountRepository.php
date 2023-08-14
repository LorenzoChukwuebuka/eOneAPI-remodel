<?php

namespace App\Interface\IRepository\Vendor;

use App\DTO\Vendor\CreateVendorBankAccountDTO;

interface IVendorBankAccountRepository
{
    public function list_banks();
    public function create_bank_account(CreateVendorBankAccountDTO $data);
    public function delete_account($id);
    public function list_accounts();
    public function list_accounts_for_a_vendor();
    public function get_account_by_id($id);
}
