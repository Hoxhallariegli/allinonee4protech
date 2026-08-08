<?php

namespace App\Domain\WarehouseManagement\CustomerAddress\Actions;

use App\Models\WarehouseManagement\CustomerAddress;
use App\Domain\WarehouseManagement\CustomerAddress\DTOs\CustomerAddressDTO;
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