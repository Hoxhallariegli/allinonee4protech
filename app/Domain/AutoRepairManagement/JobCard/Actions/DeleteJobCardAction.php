<?php

namespace App\Domain\AutoRepairManagement\JobCard\Actions;

use App\Models\AutoRepairManagement\JobCard;
use App\Models\AuditTrail;

class DeleteJobCardAction
{
    public function execute(JobCard $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCards');
        return $model->delete(); 
    }
}