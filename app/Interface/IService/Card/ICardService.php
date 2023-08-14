<?php

namespace App\Interface\IService\Card;

use App\DTO\Card\FundCardDTO;
use App\DTO\Card\CreateUserCardDTO;

interface ICardService
{
    public function create_card_for_users(CreateUserCardDTO $data);

    public function get_all_cards_for_a_particular_vendor();

    public function edit_card_status();

    public function get_user_cards($id);

    public function get_account_type();

    public function get_card_type();
 
}