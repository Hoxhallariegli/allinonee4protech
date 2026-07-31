<?php

namespace App\Domain\ConstructionERP\ProgressReport\Actions;

use App\Models\ConstructionERP\ProgressReport;
use App\Models\AuditTrail;

class DeleteProgressReportAction
{
    public function execute(ProgressReport $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ProgressReports');
        return $model->delete(); 
    }
}