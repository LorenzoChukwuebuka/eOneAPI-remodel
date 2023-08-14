<?php

namespace App\Repository\Transactions;

use App\Interface\IRepository\Card\ICardTransactionRepository;
use App\Models\CardTransaction;

class CardTransactionRepository implements ICardTransactionRepository
{
    public function __construct(CardTransaction $cardTransactionModel)
    {
        $this->cardTransactionModel = $cardTransactionModel;
    }

    public function create_card_transaction(object $data)
    {
        return $this->cardTransactionModel::create([
            'card_id' => $data->card_id,
            'amount' => $data->amount,
            'previous_balance' => $data->previous_balance,
            'transaction_reference' => $data->transaction_ref,
            'transaction_type' => $data->transaction_type,
            'status' => null,
            'current_balance' => $data->current_balance,
        ]);
    }

    public function find_transaction($id)
    {
        return $this->cardTransactionModel::find($id);
    }

}
