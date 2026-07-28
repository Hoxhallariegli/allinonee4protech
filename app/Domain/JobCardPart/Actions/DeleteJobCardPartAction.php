<?php

namespace App\Domain\JobCardPart\Actions;

use App\Models\JobCardPart;
use App\Models\AuditTrail;

class DeleteJobCardPartAction
{
    public function execute(JobCardPart $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCardParts');
        return $model->delete(); 
    }
}