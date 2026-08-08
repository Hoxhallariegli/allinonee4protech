<?php

namespace App\Domain\WarehouseManagement\CustomerAddress\Actions;

use App\Models\WarehouseManagement\CustomerAddress;
use App\Domain\WarehouseManagement\CustomerAddress\DTOs\CustomerAddressDTO;
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