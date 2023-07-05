<?php

namespace App\Repository\Card;

use App\DTO\Card\CreateUserCardDTO;
use App\Interface\IRepository\Card\ICardRepository;

class CardRepository implements ICardRepository
{
    public function create_card_for_users(CreateUserCardDTO $data)
    {}

    public function forget_card_pin()
    {}

    public function reset_card_pin()
    {}

    public function fund_cards()
    {}

    public function get_all_cards_for_a_particular_vendor()
    {}

    public function edit_card_status()
    {}

    public function get_user_cards()
    {}
}
