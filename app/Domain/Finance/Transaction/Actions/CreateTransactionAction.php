<?php

namespace App\Domain\Finance\Transaction\Actions;

use App\Models\Finance\Transaction;
use App\Domain\Finance\Transaction\DTOs\TransactionDTO;
use App\Models\AuditTrail;

class CreateTransactionAction
{
    public function execute(TransactionDTO $dto): Transaction 
    {
        $item = Transaction::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Transactions');
        return $item;
    }
}