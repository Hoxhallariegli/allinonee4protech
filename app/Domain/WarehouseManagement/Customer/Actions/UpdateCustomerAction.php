<?php

namespace App\Domain\WarehouseManagement\Customer\Actions;

use App\Models\WarehouseManagement\Customer;
use App\Domain\WarehouseManagement\Customer\DTOs\CustomerDTO;
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