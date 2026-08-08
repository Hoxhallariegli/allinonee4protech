<?php

namespace App\Domain\ECommerce\Customer\Actions;

use App\Models\ECommerce\Customer;
use App\Domain\ECommerce\Customer\DTOs\CustomerDTO;
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