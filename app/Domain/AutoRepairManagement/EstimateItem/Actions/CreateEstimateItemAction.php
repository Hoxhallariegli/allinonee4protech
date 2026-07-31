<?php

namespace App\Domain\AutoRepairManagement\EstimateItem\Actions;

use App\Models\AutoRepairManagement\EstimateItem;
use App\Domain\AutoRepairManagement\EstimateItem\DTOs\EstimateItemDTO;
use App\Models\AuditTrail;

class CreateEstimateItemAction
{
    public function execute(EstimateItemDTO $dto): EstimateItem 
    {
        $item = EstimateItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'EstimateItems');
        return $item;
    }
}