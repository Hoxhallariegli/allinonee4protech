<?php

namespace App\Domain\AutoRepairManagement\Report\Actions;

use App\Models\AutoRepairManagement\Report;
use App\Domain\AutoRepairManagement\Report\DTOs\ReportDTO;
use App\Models\AuditTrail;

class UpdateReportAction
{
    public function execute(Report $model, ReportDTO $dto): Report
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Reports');
        $model->save();
        return $model->fresh();
    }
}