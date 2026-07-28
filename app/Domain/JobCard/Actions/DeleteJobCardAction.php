<?php

namespace App\Domain\JobCard\Actions;

use App\Models\JobCard;
use App\Models\AuditTrail;

class DeleteJobCardAction
{
    public function execute(JobCard $model): bool 
    {
        AuditTrail::log($model, 'delete', 'JobCards');
        return $model->delete(); 
    }
}