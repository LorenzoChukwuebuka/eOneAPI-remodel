<?php

namespace App\Interface\IService\Vendor;

use App\DTO\Vendor\CreateVendorBankAccountDTO;

interface IVendorBankAccountService
{
    public function list_banks();
    public function create_bank_account(CreateVendorBankAccountDTO $data);
    public function delete_account($id);
    public function list_accounts();
    public function list_accounts_for_a_vendor();
    public function get_account_by_id($id);
    public function resolve_account_number($account_number,$bank_code);
}
