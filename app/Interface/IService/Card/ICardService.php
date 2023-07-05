<?php

namespace App\Interface\IService\Card;

use App\DTO\Card\CreateUserCardDTO;

interface ICardService
{
    public function create_card_for_users(CreateUserCardDTO $data);

    public function forget_card_pin();

    public function reset_card_pin();

    public function fund_cards();

    public function get_all_cards_for_a_particular_vendor();

    public function edit_card_status();

    public function get_user_cards();
}