<?php

namespace App\Http\Controllers\Card;

use App\DTO\Card\CreateUserCardDTO;
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
            return $this->fail($th->getMessage());
        }
    }

    public function forget_card_pin()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function reset_card_pin()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function fund_cards()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function get_all_cards_for_a_particular_vendor()
    {
        try {
            //code...
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

    public function get_user_cards()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    

}
