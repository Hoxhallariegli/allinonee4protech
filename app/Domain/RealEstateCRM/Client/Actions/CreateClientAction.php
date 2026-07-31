<?php

namespace App\Domain\RealEstateCRM\Client\Actions;

use App\Models\RealEstateCRM\Client;
use App\Domain\RealEstateCRM\Client\DTOs\ClientDTO;
use App\Models\AuditTrail;

class CreateClientAction
{
    public function execute(ClientDTO $dto): Client 
    {
        $item = Client::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Clients');
        return $item;
    }
}