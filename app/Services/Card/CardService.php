<?php

namespace App\Services\Card;

use App\DTO\Card\CreateUserCardDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Card\ICardRepository;
use App\Interface\IService\Card\ICardService;
use Validator;

class CardService implements ICardService
{
    public function __construct(ICardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }
    public function create_card_for_users(CreateUserCardDTO $data)
    {
        $validator = Validator::make((array) $data, [
            "user_id" => "required",
            "vendor_id" => "required",
            "pin" => "required|min:4",
            "card_type_id" => "required",
            "account_type_id" => "required",
            "interest_rate" => [],
            "card_limit" => [],
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $last_card_number = $this->cardRepository->get_last_card();

        $data->card_number = (int) $last_card_number['card_number'] + 1;

        #call the expire function
        $today = date("F j, Y, g:i a");
        $expiryDate = self::expiry_date($today);

        $data->expiry_date = $expiryDate;

        #send mail to user about card creation

        return $this->cardRepository->create_card_for_users($data);

    }

    public function forget_card_pin()
    {}

    public function reset_card_pin()
    {}

    public function fund_cards()
    {}

    public function get_all_cards_for_a_particular_vendor()
    {
        $id = auth()->user()->id;

        $result = $this->cardRepository->get_all_cards_for_a_particular_vendor($id);

        if ($result->count() == 0) {
            throw new \Exception("No records found");
        }

        return $result;
    }

    public function edit_card_status()
    {}

    public function get_user_cards($id = null)
    {
        $card = $this->cardRepository->get_user_cards($id);

        if (!$card) {
            throw new \Exception("No card found");
        }

        return $card;

    }

    public function get_account_type()
    {
        return $this->cardRepository->get_account_type();
    }

    public function get_card_type()
    {
        return $this->cardRepository->get_card_type();
    }

    private static function expiry_date($today)
    {
        $date = date_create($today);
        date_add($date, date_interval_create_from_date_string("3 years"));
        return date_format($date, "Y-m-d");
    }
}
