<?php

namespace App\Domain\AutoRepairManagement\Customer\Actions;

use App\Models\AutoRepairManagement\Customer;
use App\Domain\AutoRepairManagement\Customer\DTOs\CustomerDTO;
use App\Models\AuditTrail;

class UpdateCustomerAction
{
    public function execute(Customer $model, CustomerDTO $dto): Customer
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Customers');
        $model->save();
        return $model->fresh();
    }
}