<?php

namespace App\Domain\AutoRepairManagement\Service\Actions;

use App\Models\AutoRepairManagement\Service;
use App\Domain\AutoRepairManagement\Service\DTOs\ServiceDTO;
use App\Models\AuditTrail;

class UpdateServiceAction
{
    public function execute(Service $model, ServiceDTO $dto): Service
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Services');
        $model->save();
        return $model->fresh();
    }
}