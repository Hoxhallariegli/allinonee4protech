<?php

namespace App\Domain\AgricultureManagement\Field\Actions;

use App\Models\AgricultureManagement\Field;
use App\Domain\AgricultureManagement\Field\DTOs\FieldDTO;
use App\Models\AuditTrail;

class UpdateFieldAction
{
    public function execute(Field $model, FieldDTO $dto): Field
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Fields');
        $model->save();
        return $model->fresh();
    }
}