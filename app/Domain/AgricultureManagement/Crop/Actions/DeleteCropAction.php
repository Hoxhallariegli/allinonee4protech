<?php

namespace App\Domain\AgricultureManagement\Crop\Actions;

use App\Models\AgricultureManagement\Crop;
use App\Models\AuditTrail;

class DeleteCropAction
{
    public function execute(Crop $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Crops');
        return $model->delete(); 
    }
}