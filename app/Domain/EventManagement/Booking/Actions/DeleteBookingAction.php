<?php

namespace App\Domain\EventManagement\Booking\Actions;

use App\Models\EventManagement\Booking;
use App\Models\AuditTrail;

class DeleteBookingAction
{
    public function execute(Booking $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Bookings');
        return $model->delete(); 
    }
}