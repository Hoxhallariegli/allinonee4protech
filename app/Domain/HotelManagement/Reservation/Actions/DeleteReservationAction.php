<?php

namespace App\Domain\HotelManagement\Reservation\Actions;

use App\Models\HotelManagement\Reservation;
use App\Models\AuditTrail;

class DeleteReservationAction
{
    public function execute(Reservation $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Reservations');
        return $model->delete(); 
    }
}