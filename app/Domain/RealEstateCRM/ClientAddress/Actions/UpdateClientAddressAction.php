<?php

namespace App\Domain\RealEstateCRM\ClientAddress\Actions;

use App\Models\RealEstateCRM\ClientAddress;
use App\Domain\RealEstateCRM\ClientAddress\DTOs\ClientAddressDTO;
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