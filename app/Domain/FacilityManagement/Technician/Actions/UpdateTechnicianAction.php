<?php

namespace App\Domain\FacilityManagement\Technician\Actions;

use App\Models\FacilityManagement\Technician;
use App\Domain\FacilityManagement\Technician\DTOs\TechnicianDTO;
use App\Models\AuditTrail;

class UpdateTechnicianAction
{
    public function execute(Technician $model, TechnicianDTO $dto): Technician
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Technicians');
        $model->save();
        return $model->fresh();
    }
}