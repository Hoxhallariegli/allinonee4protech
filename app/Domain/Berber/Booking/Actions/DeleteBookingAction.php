<?php

namespace App\Domain\Berber\Booking\Actions;

use App\Models\Berber\Booking;
use App\Models\AuditTrail;

class DeleteBookingAction
{
    public function execute(Booking $model): bool
    {
        AuditTrail::log($model, 'delete', 'Bookings');
        return $model->delete();
    }
}
