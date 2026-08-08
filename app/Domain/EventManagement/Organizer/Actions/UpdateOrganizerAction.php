<?php

namespace App\Domain\EventManagement\Organizer\Actions;

use App\Models\EventManagement\Organizer;
use App\Domain\EventManagement\Organizer\DTOs\OrganizerDTO;
use App\Models\AuditTrail;

class UpdateOrganizerAction
{
    public function execute(Organizer $model, OrganizerDTO $dto): Organizer
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Organizers');
        $model->save();
        return $model->fresh();
    }
}