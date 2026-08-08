<?php

namespace App\Domain\Finance\Expense\Actions;

use App\Models\Finance\Expense;
use App\Domain\Finance\Expense\DTOs\ExpenseDTO;
use App\Models\AuditTrail;

class UpdateExpenseAction
{
    public function execute(Expense $model, ExpenseDTO $dto): Expense
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Expenses');
        $model->save();
        return $model->fresh();
    }
}