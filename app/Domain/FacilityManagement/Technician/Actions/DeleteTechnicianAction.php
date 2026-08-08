<?php

namespace App\Domain\FacilityManagement\Technician\Actions;

use App\Models\FacilityManagement\Technician;
use App\Models\AuditTrail;

class DeleteTechnicianAction
{
    public function execute(Technician $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Technicians');
        return $model->delete(); 
    }
}