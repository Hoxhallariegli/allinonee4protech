<?php

namespace App\Domain\ConstructionERP\Building\Actions;

use App\Models\ConstructionERP\Building;
use App\Models\AuditTrail;

class DeleteBuildingAction
{
    public function execute(Building $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Buildings');
        return $model->delete(); 
    }
}