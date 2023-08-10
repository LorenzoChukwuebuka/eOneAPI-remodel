<?php

namespace App\Interface\IRepository\Card;

use App\DTO\Card\CreateUserCardDTO;



interface ICardRepository
{
    public function create_card_for_users(CreateUserCardDTO $data);

    public function forget_card_pin();

    public function reset_card_pin();

    public function get_all_cards_for_a_particular_vendor($id);

    public function edit_card_status();

    public function get_user_cards($id);

    public function get_account_type();

    public function get_card_type();

    public function get_last_card();
}
