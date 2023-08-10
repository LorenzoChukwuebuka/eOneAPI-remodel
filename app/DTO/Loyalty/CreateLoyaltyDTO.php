<?php
declare (strict_types = 1);

namespace App\DTO\Loyalty;

class CreateLoyaltyDTO
{
    public function __construct(public int $vendor_id, public string $startDate, public string $endDate, public float | int $pointperunit, public float | int $costperpoint, public float | int $redemeable, public string $status = 'active')
    {

    }

}
