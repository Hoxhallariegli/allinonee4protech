<?php

namespace App\Domain\HotelManagement\Reservation\Actions;

use App\Models\HotelManagement\Reservation;
use App\Domain\HotelManagement\Reservation\DTOs\ReservationDTO;
use App\Models\AuditTrail;

class CreateReservationAction
{
    public function execute(ReservationDTO $dto): Reservation 
    {
        $item = Reservation::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Reservations');
        return $item;
    }
}