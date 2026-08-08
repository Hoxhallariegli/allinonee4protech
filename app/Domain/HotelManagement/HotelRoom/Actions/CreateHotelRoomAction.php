<?php

namespace App\Domain\HotelManagement\HotelRoom\Actions;

use App\Models\HotelManagement\HotelRoom;
use App\Domain\HotelManagement\HotelRoom\DTOs\HotelRoomDTO;
use App\Models\AuditTrail;

class CreateHotelRoomAction
{
    public function execute(HotelRoomDTO $dto): HotelRoom 
    {
        $item = HotelRoom::create($dto->toArray());
        AuditTrail::log($item, 'create', 'HotelRooms');
        return $item;
    }
}