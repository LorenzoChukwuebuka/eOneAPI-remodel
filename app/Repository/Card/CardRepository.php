<?php

namespace App\Repository\Card;

use App\DTO\Card\CreateUserCardDTO;
use App\Interface\IRepository\Card\ICardRepository;
use App\Models\AccountType;
use App\Models\Card;
use App\Models\CardType;
use Illuminate\Support\Facades\Hash;

class CardRepository implements ICardRepository
{
    public function __construct(Card $cardModel, CardType $cardTypeModel, AccountType $accountTypeModel)
    {
        $this->cardModel = $cardModel;
        $this->cardTypeModel = $cardTypeModel;
        $this->accountTypeModel = $accountTypeModel;
    }
    public function create_card_for_users(CreateUserCardDTO $data)
    {

        return $this->cardModel::create([
            "card_number" => $data->card_number,
            "expiry_date" => $data->expiry_date,
            "pin" => Hash::make($data->pin),
            "user_id" => $data->user_id,
            "vendor_id" => $data->vendor_id,
            "card_type_id" => $data->card_type_id,
            "account_type_id" => $data->account_type_id,
            "interest_rate" => $data->interest_rate,
            "card_limit" => $data->card_limit,
        ]);
    }

    public function forget_card_pin()
    {}

    public function reset_card_pin()
    {}

    public function fund_cards()
    {}

    public function get_all_cards_for_a_particular_vendor($id)
    {
        return $this->cardModel::with('vendor', 'user')->where('vendor_id', $id)->latest()->get();
    }

    public function edit_card_status()
    {}

    public function get_user_cards($id = null)
    {

        $authId = auth()->user()->id;

        $result = $id !== null ? $id : $authId;

        if ($id !== null) {
            return $this->cardModel::with('user', 'vendor')->where('vendor_id', $result)->latest()->get();
        } else {
            return $this->cardModel::with('user', 'vendor')->where('user_id', $result)->latest()->get();
        }

    }

    public function get_account_type()
    {
        return $this->accountTypeModel::latest()->get();
    }

    public function get_card_type()
    {
        return $this->cardTypeModel::latest()->get();
    }

    public function get_last_card()
    {
        return $this->cardModel::latest()->limit(1)->select('card_number')->first();
    }
}
