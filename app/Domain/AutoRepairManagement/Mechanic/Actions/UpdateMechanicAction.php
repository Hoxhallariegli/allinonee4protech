<?php

namespace App\Domain\AutoRepairManagement\Mechanic\Actions;

use App\Models\AutoRepairManagement\Mechanic;
use App\Domain\AutoRepairManagement\Mechanic\DTOs\MechanicDTO;
use App\Models\AuditTrail;

class UpdateMechanicAction
{
    public function execute(Mechanic $model, MechanicDTO $dto): Mechanic
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Mechanics');
        $model->save();
        return $model->fresh();
    }
}