<?php

namespace App\Domain\CRM\Deal\Actions;

use App\Models\CRM\Deal;
use App\Domain\CRM\Deal\DTOs\DealDTO;
use App\Models\AuditTrail;

class UpdateDealAction
{
    public function execute(Deal $model, DealDTO $dto): Deal
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Deals');
        $model->save();
        return $model->fresh();
    }
}