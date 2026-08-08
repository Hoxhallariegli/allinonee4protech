<?php

namespace App\Domain\TravelAgency\TourBooking\Actions;

use App\Models\TravelAgency\TourBooking;
use App\Models\AuditTrail;

class DeleteTourBookingAction
{
    public function execute(TourBooking $model): bool 
    {
        AuditTrail::log($model, 'delete', 'TourBookings');
        return $model->delete(); 
    }
}