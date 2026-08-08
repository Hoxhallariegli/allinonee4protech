<?php

namespace App\Domain\EventManagement\TicketType\Actions;

use App\Models\EventManagement\TicketType;
use App\Domain\EventManagement\TicketType\DTOs\TicketTypeDTO;
use App\Models\AuditTrail;

class UpdateTicketTypeAction
{
    public function execute(TicketType $model, TicketTypeDTO $dto): TicketType
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'TicketTypes');
        $model->save();
        return $model->fresh();
    }
}