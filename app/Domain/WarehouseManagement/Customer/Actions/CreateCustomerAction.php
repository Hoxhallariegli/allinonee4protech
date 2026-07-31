<?php

namespace App\Domain\WarehouseManagement\Customer\Actions;

use App\Models\WarehouseManagement\Customer;
use App\Domain\WarehouseManagement\Customer\DTOs\CustomerDTO;
use App\Models\AuditTrail;

class CreateCustomerAction
{
    public function execute(CustomerDTO $dto): Customer 
    {
        $item = Customer::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Customers');
        return $item;
    }
}