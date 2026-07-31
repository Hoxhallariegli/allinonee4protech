<?php

namespace App\Domain\ClinicManagement\Doctor\Actions;

use App\Models\ClinicManagement\Doctor;
use App\Domain\ClinicManagement\Doctor\DTOs\DoctorDTO;
use App\Models\AuditTrail;

class CreateDoctorAction
{
    public function execute(DoctorDTO $dto): Doctor 
    {
        $item = Doctor::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Doctors');
        return $item;
    }
}