<?php

namespace App\Repository\Card;

use App\DTO\Card\CreateCardHistoryDTO;
use App\Interface\IRepository\Card\ICardHistoryRepository;

class CardHistoryRepostory implements ICardHistoryRepository{
    public function create_card_history(CreateCardHistoryDTO $data){}
}