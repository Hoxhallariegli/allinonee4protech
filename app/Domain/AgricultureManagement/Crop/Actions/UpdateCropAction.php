<?php

namespace App\Domain\AgricultureManagement\Crop\Actions;

use App\Models\AgricultureManagement\Crop;
use App\Domain\AgricultureManagement\Crop\DTOs\CropDTO;
use App\Models\AuditTrail;

class UpdateCropAction
{
    public function execute(Crop $model, CropDTO $dto): Crop
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Crops');
        $model->save();
        return $model->fresh();
    }
}