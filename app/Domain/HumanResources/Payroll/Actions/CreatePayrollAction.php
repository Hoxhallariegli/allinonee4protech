<?php

namespace App\Domain\HumanResources\Payroll\Actions;

use App\Models\HumanResources\Payroll;
use App\Domain\HumanResources\Payroll\DTOs\PayrollDTO;
use App\Models\AuditTrail;

class CreatePayrollAction
{
    public function execute(PayrollDTO $dto): Payroll 
    {
        $item = Payroll::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Payrolls');
        return $item;
    }
}