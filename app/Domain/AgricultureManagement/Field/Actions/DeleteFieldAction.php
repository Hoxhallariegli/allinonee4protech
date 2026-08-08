<?php

namespace App\Domain\AgricultureManagement\Field\Actions;

use App\Models\AgricultureManagement\Field;
use App\Models\AuditTrail;

class DeleteFieldAction
{
    public function execute(Field $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Fields');
        return $model->delete(); 
    }
}