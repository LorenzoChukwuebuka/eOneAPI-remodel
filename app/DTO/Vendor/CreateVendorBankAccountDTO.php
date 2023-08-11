<?php

namespace App\DTO\Vendor;

class CreateVendorBankAccountDTO
{
    public function __construct(public int $vendor_id, public string $bank_name, public int $account_number, public string $bank_code, public string $default_account, public string $account_type = "nuban", public ?string $account_name = null )
    {
    }

}
