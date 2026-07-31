<?php

namespace App\Domain\ClinicManagement\Doctor\Actions;

use App\Models\ClinicManagement\Doctor;
use App\Domain\ClinicManagement\Doctor\DTOs\DoctorDTO;
use App\Models\AuditTrail;

class UpdateDoctorAction
{
    public function execute(Doctor $model, DoctorDTO $dto): Doctor
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Doctors');
        $model->save();
        return $model->fresh();
    }
}