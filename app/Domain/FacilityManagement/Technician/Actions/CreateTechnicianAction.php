<?php

namespace App\Domain\FacilityManagement\Technician\Actions;

use App\Models\FacilityManagement\Technician;
use App\Domain\FacilityManagement\Technician\DTOs\TechnicianDTO;
use App\Models\AuditTrail;

class CreateTechnicianAction
{
    public function execute(TechnicianDTO $dto): Technician 
    {
        $item = Technician::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Technicians');
        return $item;
    }
}