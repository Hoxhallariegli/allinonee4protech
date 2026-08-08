<?php

namespace App\Domain\TravelAgency\Destination\Actions;

use App\Models\TravelAgency\Destination;
use App\Models\AuditTrail;

class DeleteDestinationAction
{
    public function execute(Destination $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Destinations');
        return $model->delete(); 
    }
}