<?php

namespace App\Domain\HotelManagement\Reservation\Actions;

use App\Models\HotelManagement\Reservation;
use App\Domain\HotelManagement\Reservation\DTOs\ReservationDTO;
use App\Models\AuditTrail;

class UpdateReservationAction
{
    public function execute(Reservation $model, ReservationDTO $dto): Reservation
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Reservations');
        $model->save();
        return $model->fresh();
    }
}