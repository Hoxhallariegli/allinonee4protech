<?php

namespace App\Domain\TravelAgency\Client\Actions;

use App\Models\TravelAgency\Client;
use App\Domain\TravelAgency\Client\DTOs\ClientDTO;
use App\Models\AuditTrail;

class UpdateClientAction
{
    public function execute(Client $model, ClientDTO $dto): Client
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Clients');
        $model->save();
        return $model->fresh();
    }
}