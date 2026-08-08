<?php

namespace App\Domain\EventManagement\Event\Actions;

use App\Models\EventManagement\Event;
use App\Domain\EventManagement\Event\DTOs\EventDTO;
use App\Models\AuditTrail;

class UpdateEventAction
{
    public function execute(Event $model, EventDTO $dto): Event
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Events');
        $model->save();
        return $model->fresh();
    }
}