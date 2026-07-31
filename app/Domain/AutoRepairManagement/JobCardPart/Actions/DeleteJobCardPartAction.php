<?php

namespace App\Domain\AutoRepairManagement\JobCardPart\Actions;

use App\Models\AutoRepairManagement\JobCardPart;
use App\Models\AuditTrail;

class DeleteJobCardPartAction
{
    public function execute(JobCardPart $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCardParts');
        return $model->delete(); 
    }
}