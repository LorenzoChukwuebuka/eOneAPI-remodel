<?php
namespace App\DTO\Vendor;

class VendorLoginDTO
{
    public function __construct(public readonly string $username, public readonly string $password)
    {}
}
