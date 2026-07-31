<?php

namespace App\Domain\ClinicManagement\Prescription\Actions;

use App\Models\ClinicManagement\Prescription;
use App\Models\AuditTrail;

class DeletePrescriptionAction
{
    public function execute(Prescription $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Prescriptions');
        return $model->delete(); 
    }
}