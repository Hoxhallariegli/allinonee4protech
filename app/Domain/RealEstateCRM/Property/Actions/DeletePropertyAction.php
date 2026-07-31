<?php

namespace App\Domain\RealEstateCRM\Property\Actions;

use App\Models\RealEstateCRM\Property;
use App\Models\AuditTrail;

class DeletePropertyAction
{
    public function execute(Property $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Properties');
        return $model->delete(); 
    }
}