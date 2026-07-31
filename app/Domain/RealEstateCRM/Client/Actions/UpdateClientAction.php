<?php

namespace App\Domain\RealEstateCRM\Client\Actions;

use App\Models\RealEstateCRM\Client;
use App\Domain\RealEstateCRM\Client\DTOs\ClientDTO;
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