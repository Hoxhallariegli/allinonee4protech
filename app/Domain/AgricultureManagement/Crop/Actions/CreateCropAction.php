<?php

namespace App\Domain\AgricultureManagement\Crop\Actions;

use App\Models\AgricultureManagement\Crop;
use App\Domain\AgricultureManagement\Crop\DTOs\CropDTO;
use App\Models\AuditTrail;

class CreateCropAction
{
    public function execute(CropDTO $dto): Crop 
    {
        $item = Crop::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Crops');
        return $item;
    }
}