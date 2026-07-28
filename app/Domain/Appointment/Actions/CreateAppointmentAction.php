<?php

namespace App\Domain\Appointment\Actions;

use App\Models\Appointment;
use App\Domain\Appointment\DTOs\AppointmentDTO;
use App\Models\AuditTrail;

class CreateAppointmentAction
{
    public function execute(AppointmentDTO $dto): Appointment 
    {
        $item = Appointment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Appointments');
        return $item;
    }
}