<?php

namespace App\Domain\Finance\Budget\Actions;

use App\Models\Finance\Budget;
use App\Domain\Finance\Budget\DTOs\BudgetDTO;
use App\Models\AuditTrail;

class CreateBudgetAction
{
    public function execute(BudgetDTO $dto): Budget 
    {
        $item = Budget::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Budgets');
        return $item;
    }
}