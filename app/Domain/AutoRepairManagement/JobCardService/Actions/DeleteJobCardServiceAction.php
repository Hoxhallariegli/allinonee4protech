<?php

namespace App\Domain\AutoRepairManagement\JobCardService\Actions;

use App\Models\AutoRepairManagement\JobCardService;
use App\Models\AuditTrail;

class DeleteJobCardServiceAction
{
    public function execute(JobCardService $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCardServices');
        return $model->delete(); 
    }
}