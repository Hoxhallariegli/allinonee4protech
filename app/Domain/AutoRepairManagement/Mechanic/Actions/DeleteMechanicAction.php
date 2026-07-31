<?php

namespace App\Domain\AutoRepairManagement\Mechanic\Actions;

use App\Models\AutoRepairManagement\Mechanic;
use App\Models\AuditTrail;

class DeleteMechanicAction
{
    public function execute(Mechanic $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Mechanics');
        return $model->delete(); 
    }
}