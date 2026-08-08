<?php

namespace App\Domain\HotelManagement\RoomType\Actions;

use App\Models\HotelManagement\RoomType;
use App\Models\AuditTrail;

class DeleteRoomTypeAction
{
    public function execute(RoomType $model): bool 
    {
        AuditTrail::log($model, 'delete', 'RoomTypes');
        return $model->delete(); 
    }
}