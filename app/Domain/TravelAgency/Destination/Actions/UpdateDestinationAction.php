<?php

namespace App\Domain\TravelAgency\Destination\Actions;

use App\Models\TravelAgency\Destination;
use App\Domain\TravelAgency\Destination\DTOs\DestinationDTO;
use App\Models\AuditTrail;

class UpdateDestinationAction
{
    public function execute(Destination $model, DestinationDTO $dto): Destination
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Destinations');
        $model->save();
        return $model->fresh();
    }
}