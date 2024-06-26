<?php

namespace App\Http\Controllers\Transanctions;

use App\DTO\Card\DebitCardDTO;
use App\DTO\Card\FundCardDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Card\IPaymentService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiResponse;

    public function __construct(IPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function initialize_payment(Request $request)
    {
        try {
            $data = $request->except(['api_id', 'api_key']);
            $result = $this->paymentService->initialize_payment($data);
            return $this->success('payment initialized successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function verify_payment($reference)
    {
        try {
            $result = $this->paymentService->verify_payment($reference);
            return $this->success('payment confirmed successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function fund_card(Request $request)
    {
        try {
            $data = new FundCardDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->paymentService->fund_card($data);
            return $this->success('card funded successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function debit_card(Request $request)
    {
        try {
            $data = new DebitCardDTO(...$request->except(['api_id', 'api_key']));
            $result = $this->paymentService->debit_card($data);
            return $this->success('card debited successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
