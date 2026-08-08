<?php

namespace App\Domain\FleetManagement\Driver\Actions;

use App\Models\FleetManagement\Driver;
use App\Domain\FleetManagement\Driver\DTOs\DriverDTO;
use App\Models\AuditTrail;

class UpdateDriverAction
{
    public function execute(Driver $model, DriverDTO $dto): Driver
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Drivers');
        $model->save();
        return $model->fresh();
    }
}