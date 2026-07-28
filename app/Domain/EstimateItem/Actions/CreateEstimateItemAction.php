<?php

namespace App\Domain\EstimateItem\Actions;

use App\Models\EstimateItem;
use App\Domain\EstimateItem\DTOs\EstimateItemDTO;
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