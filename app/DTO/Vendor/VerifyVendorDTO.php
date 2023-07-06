<?php

namespace App\DTO\Vendor;

class VerifyVendorDTO
{
    public function __construct( public readonly ?string $token = null)
    {

    }

}
