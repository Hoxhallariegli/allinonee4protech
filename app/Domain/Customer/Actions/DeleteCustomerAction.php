<?php

namespace App\Domain\Customer\Actions;

use App\Models\Customer;
use App\Models\AuditTrail;

class DeleteCustomerAction
{
    public function execute(Customer $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Customers');
        return $model->delete(); 
    }
}