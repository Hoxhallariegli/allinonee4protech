<?php

namespace App\Domain\Mechanic\Actions;

use App\Models\Mechanic;
use App\Models\AuditTrail;

class DeleteMechanicAction
{
    public function execute(Mechanic $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Mechanics');
        return $model->delete(); 
    }
}