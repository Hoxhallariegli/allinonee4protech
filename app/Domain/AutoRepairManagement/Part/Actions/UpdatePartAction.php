<?php

namespace App\Domain\AutoRepairManagement\Part\Actions;

use App\Models\AutoRepairManagement\Part;
use App\Domain\AutoRepairManagement\Part\DTOs\PartDTO;
use App\Models\AuditTrail;

class UpdatePartAction
{
    public function execute(Part $model, PartDTO $dto): Part
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Parts');
        $model->save();
        return $model->fresh();
    }
}