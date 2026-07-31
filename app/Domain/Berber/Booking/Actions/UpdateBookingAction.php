<?php

namespace App\Domain\Berber\Booking\Actions;

use App\Models\Berber\Booking;
use App\Domain\Berber\Booking\DTOs\BookingDTO;
use App\Models\AuditTrail;

class UpdateBookingAction
{
    public function execute(Booking $model, BookingDTO $dto): Booking
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Bookings');
        $model->save();
        return $model->fresh();
    }
}
