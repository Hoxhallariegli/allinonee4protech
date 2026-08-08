<?php

namespace App\Domain\Finance\Expense\Actions;

use App\Models\Finance\Expense;
use App\Domain\Finance\Expense\DTOs\ExpenseDTO;
use App\Models\AuditTrail;

class CreateExpenseAction
{
    public function execute(ExpenseDTO $dto): Expense 
    {
        $item = Expense::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Expenses');
        return $item;
    }
}