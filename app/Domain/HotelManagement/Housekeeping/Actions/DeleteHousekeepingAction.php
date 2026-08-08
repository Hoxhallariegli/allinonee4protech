<?php

namespace App\Domain\HotelManagement\Housekeeping\Actions;

use App\Models\HotelManagement\Housekeeping;
use App\Models\AuditTrail;

class DeleteHousekeepingAction
{
    public function execute(Housekeeping $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Housekeepings');
        return $model->delete(); 
    }
}