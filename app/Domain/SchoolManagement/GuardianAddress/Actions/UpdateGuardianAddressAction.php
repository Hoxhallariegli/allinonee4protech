<?php

namespace App\Domain\SchoolManagement\GuardianAddress\Actions;

use App\Models\SchoolManagement\GuardianAddress;
use App\Domain\SchoolManagement\GuardianAddress\DTOs\GuardianAddressDTO;
use App\Models\AuditTrail;

class UpdateGuardianAddressAction
{
    public function execute(GuardianAddress $model, GuardianAddressDTO $dto): GuardianAddress
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'GuardianAddresses');
        $model->save();
        return $model->fresh();
    }
}