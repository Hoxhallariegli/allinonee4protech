<?php

namespace App\Domain\ConstructionERP\HeavyMachinery\Actions;

use App\Models\ConstructionERP\HeavyMachinery;
use App\Domain\ConstructionERP\HeavyMachinery\DTOs\HeavyMachineryDTO;
use App\Models\AuditTrail;

class UpdateHeavyMachineryAction
{
    public function execute(HeavyMachinery $model, HeavyMachineryDTO $dto): HeavyMachinery
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'HeavyMachineries');
        $model->save();
        return $model->fresh();
    }
}