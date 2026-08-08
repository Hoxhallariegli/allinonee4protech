<?php

namespace App\Domain\HotelManagement\Housekeeping\Actions;

use App\Models\HotelManagement\Housekeeping;
use App\Domain\HotelManagement\Housekeeping\DTOs\HousekeepingDTO;
use App\Models\AuditTrail;

class UpdateHousekeepingAction
{
    public function execute(Housekeeping $model, HousekeepingDTO $dto): Housekeeping
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Housekeepings');
        $model->save();
        return $model->fresh();
    }
}