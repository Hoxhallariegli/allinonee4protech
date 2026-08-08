<?php

namespace App\Domain\AutoRepairManagement\ExpenseTracking\Actions;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\DTOs\ExpenseTrackingDTO;
use App\Models\AuditTrail;

class UpdateExpenseTrackingAction
{
    public function execute(ExpenseTracking $model, ExpenseTrackingDTO $dto): ExpenseTracking
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ExpenseTrackings');
        $model->save();
        return $model->fresh();
    }
}