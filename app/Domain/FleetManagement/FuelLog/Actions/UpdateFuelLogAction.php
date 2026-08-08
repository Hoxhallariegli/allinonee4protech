<?php

namespace App\Domain\FleetManagement\FuelLog\Actions;

use App\Models\FleetManagement\FuelLog;
use App\Domain\FleetManagement\FuelLog\DTOs\FuelLogDTO;
use App\Models\AuditTrail;

class UpdateFuelLogAction
{
    public function execute(FuelLog $model, FuelLogDTO $dto): FuelLog
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'FuelLogs');
        $model->save();
        return $model->fresh();
    }
}