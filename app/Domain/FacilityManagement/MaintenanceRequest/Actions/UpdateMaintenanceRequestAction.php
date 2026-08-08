<?php

namespace App\Domain\FacilityManagement\MaintenanceRequest\Actions;

use App\Models\FacilityManagement\MaintenanceRequest;
use App\Domain\FacilityManagement\MaintenanceRequest\DTOs\MaintenanceRequestDTO;
use App\Models\AuditTrail;

class UpdateMaintenanceRequestAction
{
    public function execute(MaintenanceRequest $model, MaintenanceRequestDTO $dto): MaintenanceRequest
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'MaintenanceRequests');
        $model->save();
        return $model->fresh();
    }
}