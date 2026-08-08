<?php

namespace App\Domain\RealEstateCRM\ClientAddress\Actions;

use App\Models\RealEstateCRM\ClientAddress;
use App\Domain\RealEstateCRM\ClientAddress\DTOs\ClientAddressDTO;
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