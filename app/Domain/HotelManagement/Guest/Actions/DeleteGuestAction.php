<?php

namespace App\Domain\HotelManagement\Guest\Actions;

use App\Models\HotelManagement\Guest;
use App\Models\AuditTrail;

class DeleteGuestAction
{
    public function execute(Guest $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Guests');
        return $model->delete(); 
    }
}