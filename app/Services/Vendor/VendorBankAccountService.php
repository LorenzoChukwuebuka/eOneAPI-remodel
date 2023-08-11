<?php

namespace App\Services\Vendor;

use App\DTO\Vendor\CreateVendorBankAccountDTO;
use App\Exceptions\CustomValidationException;
use App\Interface\IRepository\Vendor\IVendorBankAccountRepository;
use App\Interface\IService\Vendor\IVendorBankAccountService;
use Validator;

class VendorBankAccountService implements IVendorBankAccountService
{

    public function __construct(IVendorBankAccountRepository $vendorBankAccountRepository)
    {
        $this->vendorBankAccountRepository = $vendorBankAccountRepository;
    }
    public function list_banks()
    {

        $key = config('paystack.paystack_secret');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$key}",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            throw new \Error("Curl Error: {$err}");
        }

        $result = json_decode($response);

        return $result;

    }
    public function create_bank_account(CreateVendorBankAccountDTO $data)
    {
        $validator = Validator::make((array) $data, [
            'account_number' => 'required',
            'vendor_id' => 'required',
            'default_account' => 'required',
            'bank_code' => 'required',
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        $account_name = $this->resolve_account_number($data->account_number, $data->bank_code);

        $data->account_name = $account_name->data->account_name;


        return $data;

    }
    public function delete_account()
    {}
    public function list_accounts()
    {}
    public function list_accounts_for_a_vendor()
    {}
    public function get_account_by_id($id)
    {}

    public function resolve_account_number($account_number, $bank_code)
    {
        $key = config('paystack.paystack_secret');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number={$account_number}&bank_code={$bank_code}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$key}",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Error("Curl Error: {$err}");
        }

        $result = json_decode($response);

        if ($result->status === false) {
            throw new \Error("Error: {$result->message}");
        }

        return $result;
    }
}
