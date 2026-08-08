<?php

namespace App\Domain\ConstructionERP\Subcontractor\Actions;

use App\Models\ConstructionERP\Subcontractor;
use App\Models\AuditTrail;

class DeleteSubcontractorAction
{
    public function execute(Subcontractor $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Subcontractors');
        return $model->delete(); 
    }
}