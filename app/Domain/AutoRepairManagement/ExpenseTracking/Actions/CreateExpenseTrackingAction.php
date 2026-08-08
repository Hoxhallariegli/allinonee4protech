<?php

namespace App\Domain\AutoRepairManagement\ExpenseTracking\Actions;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\DTOs\ExpenseTrackingDTO;
use App\Models\AuditTrail;

class CreateExpenseTrackingAction
{
    public function execute(ExpenseTrackingDTO $dto): ExpenseTracking 
    {
        $item = ExpenseTracking::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ExpenseTrackings');
        return $item;
    }
}