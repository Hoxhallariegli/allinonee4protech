<?php

namespace App\Domain\SchoolManagement\Guardian\Actions;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\DTOs\GuardianDTO;
use App\Models\AuditTrail;

class CreateGuardianAction
{
    public function execute(GuardianDTO $dto): Guardian 
    {
        $item = Guardian::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Guardians');
        return $item;
    }
}