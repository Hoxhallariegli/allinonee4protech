<?php

namespace App\Domain\EventManagement\Booking\Actions;

use App\Models\EventManagement\Booking;
use App\Domain\EventManagement\Booking\DTOs\BookingDTO;
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