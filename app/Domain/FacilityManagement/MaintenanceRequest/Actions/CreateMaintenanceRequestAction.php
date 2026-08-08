<?php

namespace App\Domain\FacilityManagement\MaintenanceRequest\Actions;

use App\Models\FacilityManagement\MaintenanceRequest;
use App\Domain\FacilityManagement\MaintenanceRequest\DTOs\MaintenanceRequestDTO;
use App\Models\AuditTrail;

class CreateMaintenanceRequestAction
{
    public function execute(MaintenanceRequestDTO $dto): MaintenanceRequest 
    {
        $item = MaintenanceRequest::create($dto->toArray());
        AuditTrail::log($item, 'create', 'MaintenanceRequests');
        return $item;
    }
}