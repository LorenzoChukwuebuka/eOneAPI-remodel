<?php

namespace App\Interface\IService\Card;

use App\DTO\Card\CreateCardHistoryDTO;

interface ICardHistoryService
{
    public function create_card_history(CreateCardHistoryDTO $data);

}
