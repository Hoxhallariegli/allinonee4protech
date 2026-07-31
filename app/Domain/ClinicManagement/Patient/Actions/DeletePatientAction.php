<?php

namespace App\Domain\ClinicManagement\Patient\Actions;

use App\Models\ClinicManagement\Patient;
use App\Models\AuditTrail;

class DeletePatientAction
{
    public function execute(Patient $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Patients');
        return $model->delete(); 
    }
}