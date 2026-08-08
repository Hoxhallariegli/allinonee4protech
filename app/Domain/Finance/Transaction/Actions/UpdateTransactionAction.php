<?php

namespace App\Domain\Finance\Transaction\Actions;

use App\Models\Finance\Transaction;
use App\Domain\Finance\Transaction\DTOs\TransactionDTO;
use App\Models\AuditTrail;

class UpdateTransactionAction
{
    public function execute(Transaction $model, TransactionDTO $dto): Transaction
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Transactions');
        $model->save();
        return $model->fresh();
    }
}