<?php

namespace App\Http\Controllers\Card;

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
            $result = $this->paymentService->initialize_payment(...$request->except(['api_id', 'api_key']));
            return $this->success('payment initialized successfully', $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function verify_payment($reference)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
