<?php

namespace App\Domain\AutoRepairManagement\Service\Actions;

use App\Models\AutoRepairManagement\Service;
use App\Domain\AutoRepairManagement\Service\DTOs\ServiceDTO;
use App\Models\AuditTrail;

class CreateServiceAction
{
    public function execute(ServiceDTO $dto): Service 
    {
        $item = Service::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Services');
        return $item;
    }
}