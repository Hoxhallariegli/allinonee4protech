<?php

namespace App\Domain\AutoRepairManagement\Report\Actions;

use App\Models\AutoRepairManagement\Report;
use App\Domain\AutoRepairManagement\Report\DTOs\ReportDTO;
use App\Models\AuditTrail;

class CreateReportAction
{
    public function execute(ReportDTO $dto): Report 
    {
        $item = Report::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Reports');
        return $item;
    }
}