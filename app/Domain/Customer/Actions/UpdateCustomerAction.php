<?php

namespace App\Domain\Customer\Actions;

use App\Models\Customer;
use App\Domain\Customer\DTOs\CustomerDTO;
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