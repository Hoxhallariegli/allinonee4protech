<?php

namespace App\Domain\HumanResources\Payroll\Actions;

use App\Models\HumanResources\Payroll;
use App\Domain\HumanResources\Payroll\DTOs\PayrollDTO;
use App\Models\AuditTrail;

class UpdatePayrollAction
{
    public function execute(Payroll $model, PayrollDTO $dto): Payroll
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Payrolls');
        $model->save();
        return $model->fresh();
    }
}