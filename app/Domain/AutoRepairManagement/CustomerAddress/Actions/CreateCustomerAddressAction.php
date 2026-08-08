<?php

namespace App\Domain\AutoRepairManagement\CustomerAddress\Actions;

use App\Models\AutoRepairManagement\CustomerAddress;
use App\Domain\AutoRepairManagement\CustomerAddress\DTOs\CustomerAddressDTO;
use App\Models\AuditTrail;

class CreateCustomerAddressAction
{
    public function execute(CustomerAddressDTO $dto): CustomerAddress 
    {
        $item = CustomerAddress::create($dto->toArray());
        AuditTrail::log($item, 'create', 'CustomerAddresses');
        return $item;
    }
}