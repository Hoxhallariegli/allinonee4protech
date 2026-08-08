<?php

namespace App\Domain\ClinicManagement\PatientAddress\Actions;

use App\Models\ClinicManagement\PatientAddress;
use App\Domain\ClinicManagement\PatientAddress\DTOs\PatientAddressDTO;
use App\Models\AuditTrail;

class CreatePatientAddressAction
{
    public function execute(PatientAddressDTO $dto): PatientAddress 
    {
        $item = PatientAddress::create($dto->toArray());
        AuditTrail::log($item, 'create', 'PatientAddresses');
        return $item;
    }
}