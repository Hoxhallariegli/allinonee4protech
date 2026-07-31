<?php

namespace App\Domain\ClinicManagement\Visit\Actions;

use App\Models\ClinicManagement\Visit;
use App\Models\AuditTrail;

class DeleteVisitAction
{
    public function execute(Visit $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Visits');
        return $model->delete(); 
    }
}