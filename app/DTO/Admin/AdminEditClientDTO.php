<?php
namespace App\DTO\Admin;

class AdminEditClientDTO
{
    public function __construct(
        public  ? int $id,
        public  ? string $businessname = null,
        public  ? string $region = null,
        public  ? string $state = null,
        public  ? string $city = null,
        public  ? string $address = null,
        public  ? string $email = null,
        public  ? string $phone_number = null
    ) {}
}
