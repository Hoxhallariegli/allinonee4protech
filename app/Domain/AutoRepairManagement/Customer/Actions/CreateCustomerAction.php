<?php

namespace App\Domain\AutoRepairManagement\Customer\Actions;

use App\Models\AutoRepairManagement\Customer;
use App\Domain\AutoRepairManagement\Customer\DTOs\CustomerDTO;
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