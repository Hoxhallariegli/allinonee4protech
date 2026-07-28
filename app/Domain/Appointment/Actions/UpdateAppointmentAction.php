<?php

namespace App\Domain\Appointment\Actions;

use App\Models\Appointment;
use App\Domain\Appointment\DTOs\AppointmentDTO;
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