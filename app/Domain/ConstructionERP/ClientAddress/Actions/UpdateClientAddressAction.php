<?php

namespace App\Domain\ConstructionERP\ClientAddress\Actions;

use App\Models\ConstructionERP\ClientAddress;
use App\Domain\ConstructionERP\ClientAddress\DTOs\ClientAddressDTO;
use App\Models\AuditTrail;

class UpdateClientAddressAction
{
    public function execute(ClientAddress $model, ClientAddressDTO $dto): ClientAddress
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ClientAddresses');
        $model->save();
        return $model->fresh();
    }
}