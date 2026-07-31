<?php

namespace App\Domain\AutoRepairManagement\Appointment\Actions;

use App\Models\AutoRepairManagement\Appointment;
use App\Domain\AutoRepairManagement\Appointment\DTOs\AppointmentDTO;
use App\Models\AuditTrail;

class UpdateAppointmentAction
{
    public function execute(Appointment $model, AppointmentDTO $dto): Appointment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Appointments');
        $model->save();
        return $model->fresh();
    }
}