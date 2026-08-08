<?php

namespace App\Domain\HotelManagement\HotelRoom\Actions;

use App\Models\HotelManagement\HotelRoom;
use App\Domain\HotelManagement\HotelRoom\DTOs\HotelRoomDTO;
use App\Models\AuditTrail;

class UpdateHotelRoomAction
{
    public function execute(HotelRoom $model, HotelRoomDTO $dto): HotelRoom
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'HotelRooms');
        $model->save();
        return $model->fresh();
    }
}