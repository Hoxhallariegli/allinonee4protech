<?php

namespace App\Domain\AutoRepairManagement\Estimate\Actions;

use App\Models\AutoRepairManagement\Estimate;
use App\Domain\AutoRepairManagement\Estimate\DTOs\EstimateDTO;
use App\Models\AuditTrail;

class CreateEstimateAction
{
    public function execute(EstimateDTO $dto): Estimate 
    {
        $item = Estimate::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Estimates');
        return $item;
    }
}