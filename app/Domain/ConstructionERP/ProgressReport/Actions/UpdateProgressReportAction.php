<?php

namespace App\Domain\ConstructionERP\ProgressReport\Actions;

use App\Models\ConstructionERP\ProgressReport;
use App\Domain\ConstructionERP\ProgressReport\DTOs\ProgressReportDTO;
use App\Models\AuditTrail;

class UpdateProgressReportAction
{
    public function execute(ProgressReport $model, ProgressReportDTO $dto): ProgressReport
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ProgressReports');
        $model->save();
        return $model->fresh();
    }
}