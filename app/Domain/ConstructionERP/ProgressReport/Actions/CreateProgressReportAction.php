<?php

namespace App\Domain\ConstructionERP\ProgressReport\Actions;

use App\Models\ConstructionERP\ProgressReport;
use App\Domain\ConstructionERP\ProgressReport\DTOs\ProgressReportDTO;
use App\Models\AuditTrail;

class CreateProgressReportAction
{
    public function execute(ProgressReportDTO $dto): ProgressReport 
    {
        $item = ProgressReport::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ProgressReports');
        return $item;
    }
}