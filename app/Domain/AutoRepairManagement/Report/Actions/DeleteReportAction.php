<?php

namespace App\Domain\AutoRepairManagement\Report\Actions;

use App\Models\AutoRepairManagement\Report;
use App\Models\AuditTrail;

class DeleteReportAction
{
    public function execute(Report $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Reports');
        return $model->delete(); 
    }
}