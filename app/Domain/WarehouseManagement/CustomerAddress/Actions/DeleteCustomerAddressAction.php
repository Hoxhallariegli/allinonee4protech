<?php

namespace App\Domain\WarehouseManagement\CustomerAddress\Actions;

use App\Models\WarehouseManagement\CustomerAddress;
use App\Models\AuditTrail;

class DeleteCustomerAddressAction
{
    public function execute(CustomerAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'CustomerAddresses');
        return $model->delete(); 
    }
}