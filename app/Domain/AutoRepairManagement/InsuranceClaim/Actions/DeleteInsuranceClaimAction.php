<?php

namespace App\Domain\AutoRepairManagement\InsuranceClaim\Actions;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Models\AuditTrail;

class DeleteInsuranceClaimAction
{
    public function execute(InsuranceClaim $model): bool 
    {
        AuditTrail::log($model, 'delete', 'InsuranceClaims');
        return $model->delete(); 
    }
}