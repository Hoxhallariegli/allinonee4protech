<?php

namespace App\Domain\LegalManagement\Client\Actions;

use App\Models\LegalManagement\Client;
use App\Domain\LegalManagement\Client\DTOs\ClientDTO;
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