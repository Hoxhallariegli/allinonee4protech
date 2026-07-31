<?php

namespace App\Domain\SchoolManagement\Guardian\Actions;

use App\Models\SchoolManagement\Guardian;
use App\Models\AuditTrail;

class DeleteGuardianAction
{
    public function execute(Guardian $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Guardians');
        return $model->delete(); 
    }
}