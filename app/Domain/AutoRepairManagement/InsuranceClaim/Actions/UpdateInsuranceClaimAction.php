<?php

namespace App\Domain\AutoRepairManagement\InsuranceClaim\Actions;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Domain\AutoRepairManagement\InsuranceClaim\DTOs\InsuranceClaimDTO;
use App\Models\AuditTrail;

class UpdateInsuranceClaimAction
{
    public function execute(InsuranceClaim $model, InsuranceClaimDTO $dto): InsuranceClaim
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'InsuranceClaims');
        $model->save();
        return $model->fresh();
    }
}