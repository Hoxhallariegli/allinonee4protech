<?php

namespace App\Domain\AutoRepairManagement\Part\Actions;

use App\Models\AutoRepairManagement\Part;
use App\Models\AuditTrail;

class DeletePartAction
{
    public function execute(Part $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Parts');
        return $model->delete(); 
    }
}