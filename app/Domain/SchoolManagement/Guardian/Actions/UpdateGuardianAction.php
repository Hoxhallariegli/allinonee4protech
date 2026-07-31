<?php

namespace App\Domain\SchoolManagement\Guardian\Actions;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\DTOs\GuardianDTO;
use App\Models\AuditTrail;

class UpdateGuardianAction
{
    public function execute(Guardian $model, GuardianDTO $dto): Guardian
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Guardians');
        $model->save();
        return $model->fresh();
    }
}