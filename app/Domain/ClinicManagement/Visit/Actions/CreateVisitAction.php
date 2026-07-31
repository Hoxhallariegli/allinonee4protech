<?php

namespace App\Domain\ClinicManagement\Visit\Actions;

use App\Models\ClinicManagement\Visit;
use App\Domain\ClinicManagement\Visit\DTOs\VisitDTO;
use App\Models\AuditTrail;

class CreateVisitAction
{
    public function execute(VisitDTO $dto): Visit 
    {
        $item = Visit::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Visits');
        return $item;
    }
}