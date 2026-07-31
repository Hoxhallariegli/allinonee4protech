<?php

namespace App\Domain\ConstructionERP\Client\Actions;

use App\Models\ConstructionERP\Client;
use App\Domain\ConstructionERP\Client\DTOs\ClientDTO;
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