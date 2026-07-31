<?php

namespace App\Domain\AutoRepairManagement\Appointment\Actions;

use App\Models\AutoRepairManagement\Appointment;
use App\Domain\AutoRepairManagement\Appointment\DTOs\AppointmentDTO;
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