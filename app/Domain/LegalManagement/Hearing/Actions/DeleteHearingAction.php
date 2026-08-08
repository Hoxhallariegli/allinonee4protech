<?php

namespace App\Domain\LegalManagement\Hearing\Actions;

use App\Models\LegalManagement\Hearing;
use App\Models\AuditTrail;

class DeleteHearingAction
{
    public function execute(Hearing $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Hearings');
        return $model->delete(); 
    }
}