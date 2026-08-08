<?php

namespace App\Domain\ClinicManagement\PatientAddress\Actions;

use App\Models\ClinicManagement\PatientAddress;
use App\Models\AuditTrail;

class DeletePatientAddressAction
{
    public function execute(PatientAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PatientAddresses');
        return $model->delete(); 
    }
}