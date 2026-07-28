<?php

namespace App\Domain\Appointment\Actions;

use App\Models\Appointment;
use App\Models\AuditTrail;

class DeleteAppointmentAction
{
    public function execute(Appointment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Appointments');
        return $model->delete(); 
    }
}