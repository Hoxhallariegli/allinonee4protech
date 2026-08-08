<?php

namespace App\Domain\TravelAgency\TourBooking\Actions;

use App\Models\TravelAgency\TourBooking;
use App\Domain\TravelAgency\TourBooking\DTOs\TourBookingDTO;
use App\Models\AuditTrail;

class UpdateTourBookingAction
{
    public function execute(TourBooking $model, TourBookingDTO $dto): TourBooking
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'TourBookings');
        $model->save();
        return $model->fresh();
    }
}