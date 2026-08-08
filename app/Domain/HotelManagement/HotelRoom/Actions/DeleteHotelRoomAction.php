<?php

namespace App\Domain\HotelManagement\HotelRoom\Actions;

use App\Models\HotelManagement\HotelRoom;
use App\Models\AuditTrail;

class DeleteHotelRoomAction
{
    public function execute(HotelRoom $model): bool 
    {
        AuditTrail::log($model, 'delete', 'HotelRooms');
        return $model->delete(); 
    }
}