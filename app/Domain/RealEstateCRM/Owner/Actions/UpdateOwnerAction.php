<?php

namespace App\Domain\RealEstateCRM\Owner\Actions;

use App\Models\RealEstateCRM\Owner;
use App\Domain\RealEstateCRM\Owner\DTOs\OwnerDTO;
use App\Models\AuditTrail;

class UpdateOwnerAction
{
    public function execute(Owner $model, OwnerDTO $dto): Owner
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Owners');
        $model->save();
        return $model->fresh();
    }
}