<?php

namespace App\Interface\IRepository\Card;

use App\DTO\Card\CreateCardHistoryDTO;

interface ICardHistoryRepository
{
    public function create_card_history(CreateCardHistoryDTO $data);

}
