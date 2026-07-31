<?php

namespace App\Domain\ConstructionERP\Apartment\Actions;

use App\Models\ConstructionERP\Apartment;
use App\Models\AuditTrail;

class DeleteApartmentAction
{
    public function execute(Apartment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Apartments');
        return $model->delete(); 
    }
}