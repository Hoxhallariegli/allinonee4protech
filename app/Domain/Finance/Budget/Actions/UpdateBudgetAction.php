<?php

namespace App\Domain\Finance\Budget\Actions;

use App\Models\Finance\Budget;
use App\Domain\Finance\Budget\DTOs\BudgetDTO;
use App\Models\AuditTrail;

class UpdateBudgetAction
{
    public function execute(Budget $model, BudgetDTO $dto): Budget
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Budgets');
        $model->save();
        return $model->fresh();
    }
}