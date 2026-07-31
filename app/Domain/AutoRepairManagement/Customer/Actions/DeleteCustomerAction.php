<?php

namespace App\Domain\AutoRepairManagement\Customer\Actions;

use App\Models\AutoRepairManagement\Customer;
use App\Models\AuditTrail;

class DeleteCustomerAction
{
    public function execute(Customer $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Customers');
        return $model->delete(); 
    }
}