<?php

namespace App\Domain\HotelManagement\Guest\Actions;

use App\Models\HotelManagement\Guest;
use App\Domain\HotelManagement\Guest\DTOs\GuestDTO;
use App\Models\AuditTrail;

class UpdateGuestAction
{
    public function execute(Guest $model, GuestDTO $dto): Guest
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Guests');
        $model->save();
        return $model->fresh();
    }
}