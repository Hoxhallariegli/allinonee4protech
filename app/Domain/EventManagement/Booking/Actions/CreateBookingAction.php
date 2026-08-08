<?php

namespace App\Domain\EventManagement\Booking\Actions;

use App\Models\EventManagement\Booking;
use App\Domain\EventManagement\Booking\DTOs\BookingDTO;
use App\Models\AuditTrail;

class CreateBookingAction
{
    public function execute(BookingDTO $dto): Booking 
    {
        $item = Booking::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Bookings');
        return $item;
    }
}