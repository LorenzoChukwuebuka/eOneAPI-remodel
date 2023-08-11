<?php

namespace App\DTO\Vendor;

class CreateVendorBankAccountDTO
{
    public function __construct(public int $vendor_id, public string $bank_name, public int $account_number, public string $account_name, public string $bank_code, public string $default_account)
    {
    }

}
