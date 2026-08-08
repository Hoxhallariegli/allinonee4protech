<?php

namespace App\Domain\TravelAgency\TourBooking\Actions;

use App\Models\TravelAgency\TourBooking;
use App\Domain\TravelAgency\TourBooking\DTOs\TourBookingDTO;
use App\Models\AuditTrail;

class CreateTourBookingAction
{
    public function execute(TourBookingDTO $dto): TourBooking 
    {
        $item = TourBooking::create($dto->toArray());
        AuditTrail::log($item, 'create', 'TourBookings');
        return $item;
    }
}