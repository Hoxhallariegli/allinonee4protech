<?php

namespace App\Domain\SchoolManagement\GuardianAddress\Actions;

use App\Models\SchoolManagement\GuardianAddress;
use App\Domain\SchoolManagement\GuardianAddress\DTOs\GuardianAddressDTO;
use App\Models\AuditTrail;

class CreateGuardianAddressAction
{
    public function execute(GuardianAddressDTO $dto): GuardianAddress 
    {
        $item = GuardianAddress::create($dto->toArray());
        AuditTrail::log($item, 'create', 'GuardianAddresses');
        return $item;
    }
}