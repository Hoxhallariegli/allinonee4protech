<?php

namespace App\Domain\LegalManagement\Client\Actions;

use App\Models\LegalManagement\Client;
use App\Domain\LegalManagement\Client\DTOs\ClientDTO;
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