<?php

namespace App\Repository\Transactions;

use App\Interface\IRepository\Card\IPaymentRepository;
use App\Models\WalletTransaction;

class PaymentRepository implements IPaymentRepository
{
    public function __construct(WalletTransaction $walletTransactionModel)
    {
        $this->walletTransactionModel = $walletTransactionModel;
    }

    public function create_credit_transaction(object $data)
    {
        return $this->walletTransactionModel::create([
            'user_id' => $data->user_id,
            'amount' => $data->amount,
            'transaction_type' => $data->transaction_type,
            'transaction_reference' => $data->reference,
            'status' => $data->status,
            'meta_data' => $data->meta_data
        ]);
    }
    public function debit_user_account()
    {}
    public function get_all_transactions_for_a_user()
    {}
    public function get_user_transactions()
    {}
}
