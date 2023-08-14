<?php

namespace App\Http\Controllers\Card;

use App\DTO\Card\CreateUserCardDTO;
use App\DTO\Card\FundCardDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Card\ICardService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    use ApiResponse;
    public function __construct(ICardService $cardService)
    {
        $this->cardService = $cardService;
    }
    public function create_card_for_users(Request $request)
    {
        try {
            $data = new CreateUserCardDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->cardService->create_card_for_users($data);
            return $this->success('card created successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail([$th->getMessage(), $th->getLine(), $th->getFile()]);
        }
    }

    public function get_all_cards_for_a_particular_vendor()
    {
        try {
            $result = $this->cardService->get_all_cards_for_a_particular_vendor();
            return $this->success('card retrieved successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function edit_card_status()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function get_user_card_details($id)
    {
        try {
            $result = $this->cardService->get_user_cards($id);
            return $this->success('card retrieved successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function get_account_type()
    {
        try {
            $result = $this->cardService->get_account_type();
            return $this->success('accounttype retrived successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function get_card_type()
    {
        try {
            $result = $this->cardService->get_card_type();
            return $this->success('cardtype retrived successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    

}
