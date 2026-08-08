<?php

namespace App\Domain\SchoolManagement\GuardianAddress\Actions;

use App\Models\SchoolManagement\GuardianAddress;
use App\Models\AuditTrail;

class DeleteGuardianAddressAction
{
    public function execute(GuardianAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'GuardianAddresses');
        return $model->delete(); 
    }
}