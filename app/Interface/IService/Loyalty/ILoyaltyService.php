<?php

namespace App\Interface\IService\Loyalty;

use App\DTO\Loyalty\CreateLoyaltyDTO;

interface ILoyaltyService
{
    public function create_loyalty(CreateLoyaltyDTO $data);
    public function get_all_loyalty_for_a_particular_vendor();
    public function get_all_loyalty();
    public function get_single_loyalty($id);
    public function update_loyalty(CreateLoyaltyDTO $data);
    public function delete_loyalty();

}
