<?php

namespace App\Domain\FacilityManagement\Building\Actions;

use App\Models\FacilityManagement\Building;
use App\Models\AuditTrail;

class DeleteBuildingAction
{
    public function execute(Building $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Buildings');
        return $model->delete(); 
    }
}