<?php

namespace App\Http\Controllers\Vendor;

use App\DTO\Vendor\CreateVendorBankAccountDTO;
use App\Http\Controllers\Controller;
use App\Interface\IService\Vendor\IVendorBankAccountService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VendorBankController extends Controller
{
    use ApiResponse;

    public function __construct(IVendorBankAccountService $vendorBankAccountService)
    {
        $this->vendorBankAccountService = $vendorBankAccountService;
    }

    public function list_banks()
    {
        try {
            $result = $this->vendorBankAccountService->list_banks();
            return $this->success("listed banks successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function create_bank_account(Request $request)
    {
        try {
            $data = new CreateVendorBankAccountDTO(
                auth()->user()->id,
                $request->input('bank_name'),
                $request->input('account_number'),
                $request->input('bank_code'),
                $request->input('default_account')

            );
            $result = $this->vendorBankAccountService->create_bank_account($data);
            return $this->success("bank created successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function resolve_bank_details(Request $request)
    {
        try {
            $result = $this->vendorBankAccountService->resolve_account_number($request->account_number, $request->bank_code);
            return $this->success("account resolved successfully", $result, 200);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
