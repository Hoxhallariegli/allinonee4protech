<?php

namespace App\Domain\AutoRepairManagement\Appointment\Actions;

use App\Models\AutoRepairManagement\Appointment;
use App\Models\AuditTrail;

class DeleteAppointmentAction
{
    public function execute(Appointment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Appointments');
        return $model->delete(); 
    }
}