<?php

namespace App\Domain\ConstructionERP\Material\Actions;

use App\Models\ConstructionERP\Material;
use App\Models\AuditTrail;

class DeleteMaterialAction
{
    public function execute(Material $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Materials');
        return $model->delete(); 
    }
}