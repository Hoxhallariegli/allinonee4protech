<?php

namespace App\Domain\HotelManagement\RoomType\Actions;

use App\Models\HotelManagement\RoomType;
use App\Domain\HotelManagement\RoomType\DTOs\RoomTypeDTO;
use App\Models\AuditTrail;

class UpdateRoomTypeAction
{
    public function execute(RoomType $model, RoomTypeDTO $dto): RoomType
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'RoomTypes');
        $model->save();
        return $model->fresh();
    }
}