<?php

namespace App\Domain\AutoRepairManagement\CustomerAddress\Actions;

use App\Models\AutoRepairManagement\CustomerAddress;
use App\Domain\AutoRepairManagement\CustomerAddress\DTOs\CustomerAddressDTO;
use App\Models\AuditTrail;

class UpdateCustomerAddressAction
{
    public function execute(CustomerAddress $model, CustomerAddressDTO $dto): CustomerAddress
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'CustomerAddresses');
        $model->save();
        return $model->fresh();
    }
}