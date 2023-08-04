<?php

namespace App\Services\Card;

use App\DTO\Card\CreateCardHistoryDTO;
use App\Interface\IService\Card\ICardHistoryService;

class CardHistoryService implements ICardHistoryService
{
    public function __construct(ICardHistoryService $cardHistoryService)
    {
        $this->cardHistoryService = $cardHistoryService;
    }
    public function create_card_history(CreateCardHistoryDTO $data)
    {
        return $this->cardHistoryService->create_card_history($data);
    }
}
