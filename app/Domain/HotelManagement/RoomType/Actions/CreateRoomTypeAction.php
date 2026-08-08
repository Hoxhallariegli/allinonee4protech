<?php

namespace App\Domain\HotelManagement\RoomType\Actions;

use App\Models\HotelManagement\RoomType;
use App\Domain\HotelManagement\RoomType\DTOs\RoomTypeDTO;
use App\Models\AuditTrail;

class CreateRoomTypeAction
{
    public function execute(RoomTypeDTO $dto): RoomType 
    {
        $item = RoomType::create($dto->toArray());
        AuditTrail::log($item, 'create', 'RoomTypes');
        return $item;
    }
}