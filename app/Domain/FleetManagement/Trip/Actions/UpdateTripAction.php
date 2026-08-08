<?php

namespace App\Domain\FleetManagement\Trip\Actions;

use App\Models\FleetManagement\Trip;
use App\Domain\FleetManagement\Trip\DTOs\TripDTO;
use App\Models\AuditTrail;

class UpdateTripAction
{
    public function execute(Trip $model, TripDTO $dto): Trip
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Trips');
        $model->save();
        return $model->fresh();
    }
}