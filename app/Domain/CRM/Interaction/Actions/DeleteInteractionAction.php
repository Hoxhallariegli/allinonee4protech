<?php

namespace App\Domain\CRM\Interaction\Actions;

use App\Models\CRM\Interaction;
use App\Models\AuditTrail;

class DeleteInteractionAction
{
    public function execute(Interaction $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Interactions');
        return $model->delete(); 
    }
}