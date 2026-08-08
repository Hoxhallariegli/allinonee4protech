<?php

namespace App\Domain\ConstructionERP\ClientAddress\Actions;

use App\Models\ConstructionERP\ClientAddress;
use App\Domain\ConstructionERP\ClientAddress\DTOs\ClientAddressDTO;
use App\Models\AuditTrail;

class CreateClientAddressAction
{
    public function execute(ClientAddressDTO $dto): ClientAddress 
    {
        $item = ClientAddress::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ClientAddresses');
        return $item;
    }
}