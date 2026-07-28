<?php

namespace App\Domain\JobCardService\Actions;

use App\Models\JobCardService;
use App\Models\AuditTrail;

class DeleteJobCardServiceAction
{
    public function execute(JobCardService $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCardServices');
        return $model->delete(); 
    }
}