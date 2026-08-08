<?php

namespace App\Domain\ConstructionERP\HeavyMachinery\Actions;

use App\Models\ConstructionERP\HeavyMachinery;
use App\Models\AuditTrail;

class DeleteHeavyMachineryAction
{
    public function execute(HeavyMachinery $model): bool 
    {
        AuditTrail::log($model, 'delete', 'HeavyMachineries');
        return $model->delete(); 
    }
}