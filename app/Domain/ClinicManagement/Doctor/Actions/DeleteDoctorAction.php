<?php

namespace App\Domain\ClinicManagement\Doctor\Actions;

use App\Models\ClinicManagement\Doctor;
use App\Models\AuditTrail;

class DeleteDoctorAction
{
    public function execute(Doctor $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Doctors');
        return $model->delete(); 
    }
}