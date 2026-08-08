<?php

namespace App\Domain\ClinicManagement\MedicalVital\Actions;

use App\Models\ClinicManagement\MedicalVital;
use App\Models\AuditTrail;

class DeleteMedicalVitalAction
{
    public function execute(MedicalVital $model): bool 
    {
        AuditTrail::log($model, 'delete', 'MedicalVitals');
        return $model->delete(); 
    }
}