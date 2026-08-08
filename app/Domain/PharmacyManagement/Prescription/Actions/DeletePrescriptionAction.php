<?php

namespace App\Domain\PharmacyManagement\Prescription\Actions;

use App\Models\PharmacyManagement\Prescription;
use App\Models\AuditTrail;

class DeletePrescriptionAction
{
    public function execute(Prescription $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Prescriptions');
        return $model->delete(); 
    }
}