<?php

namespace App\Domain\Estimate\Actions;

use App\Models\Estimate;
use App\Domain\Estimate\DTOs\EstimateDTO;
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