<?php

namespace App\Repository\Card;

use App\DTO\Card\CreateCardHistoryDTO;
use App\Interface\IRepository\Card\ICardHistoryRepository;
use App\Models\CardHistory;

class CardHistoryRepository implements ICardHistoryRepository
{
    public function __construct(CardHistory $cardHistoryModel)
    {
        $this->cardHistoryModel = $cardHistoryModel;
    }
    public function create_card_history(CreateCardHistoryDTO $data)
    {
        return $this->cardHistoryModel->create([
            "card_number" => $data->card_number,
            "data" => $data->data,
            "remark" => $data->remark,
        ]);
    }
}


 