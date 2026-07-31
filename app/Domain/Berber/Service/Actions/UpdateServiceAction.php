<?php

namespace App\Domain\Berber\Service\Actions;

use App\Models\Berber\Service;
use App\Domain\Berber\Service\DTOs\ServiceDTO;
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
