<?php

namespace App\Domain\RealEstateCRM\Property\Actions;

use App\Models\RealEstateCRM\Property;
use App\Domain\RealEstateCRM\Property\DTOs\PropertyDTO;
use App\Models\AuditTrail;

class UpdatePropertyAction
{
    public function execute(Property $model, PropertyDTO $dto): Property
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Properties');
        $model->save();
        return $model->fresh();
    }
}