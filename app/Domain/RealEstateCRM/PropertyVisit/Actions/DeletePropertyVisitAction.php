<?php

namespace App\Domain\RealEstateCRM\PropertyVisit\Actions;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Models\AuditTrail;

class DeletePropertyVisitAction
{
    public function execute(PropertyVisit $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PropertyVisits');
        return $model->delete(); 
    }
}