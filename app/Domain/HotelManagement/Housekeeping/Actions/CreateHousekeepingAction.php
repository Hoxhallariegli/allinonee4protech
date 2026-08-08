<?php

namespace App\Domain\HotelManagement\Housekeeping\Actions;

use App\Models\HotelManagement\Housekeeping;
use App\Domain\HotelManagement\Housekeeping\DTOs\HousekeepingDTO;
use App\Models\AuditTrail;

class CreateHousekeepingAction
{
    public function execute(HousekeepingDTO $dto): Housekeeping 
    {
        $item = Housekeeping::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Housekeepings');
        return $item;
    }
}