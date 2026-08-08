<?php

namespace App\Domain\TravelAgency\Client\Actions;

use App\Models\TravelAgency\Client;
use App\Domain\TravelAgency\Client\DTOs\ClientDTO;
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