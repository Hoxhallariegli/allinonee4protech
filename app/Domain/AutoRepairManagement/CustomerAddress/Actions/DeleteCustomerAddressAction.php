<?php

namespace App\Domain\AutoRepairManagement\CustomerAddress\Actions;

use App\Models\AutoRepairManagement\CustomerAddress;
use App\Models\AuditTrail;

class DeleteCustomerAddressAction
{
    public function execute(CustomerAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'CustomerAddresses');
        return $model->delete(); 
    }
}