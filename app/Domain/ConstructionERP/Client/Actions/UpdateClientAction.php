<?php

namespace App\Domain\ConstructionERP\Client\Actions;

use App\Models\ConstructionERP\Client;
use App\Domain\ConstructionERP\Client\DTOs\ClientDTO;
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