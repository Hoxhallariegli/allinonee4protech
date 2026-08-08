<?php

namespace App\Domain\BerberApp\Booking\Actions;

use App\Models\BerberApp\Booking;
use App\Domain\BerberApp\Booking\DTOs\BookingDTO;
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