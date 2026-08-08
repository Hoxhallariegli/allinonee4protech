<?php

namespace App\Domain\AutoRepairManagement\InsuranceClaim\Actions;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Domain\AutoRepairManagement\InsuranceClaim\DTOs\InsuranceClaimDTO;
use App\Models\AuditTrail;

class CreateInsuranceClaimAction
{
    public function execute(InsuranceClaimDTO $dto): InsuranceClaim 
    {
        $item = InsuranceClaim::create($dto->toArray());
        AuditTrail::log($item, 'create', 'InsuranceClaims');
        return $item;
    }
}