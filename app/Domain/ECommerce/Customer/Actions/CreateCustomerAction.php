<?php

namespace App\Domain\ECommerce\Customer\Actions;

use App\Models\ECommerce\Customer;
use App\Domain\ECommerce\Customer\DTOs\CustomerDTO;
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