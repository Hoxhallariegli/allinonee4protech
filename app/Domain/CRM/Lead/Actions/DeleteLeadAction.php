<?php

namespace App\Domain\CRM\Lead\Actions;

use App\Models\CRM\Lead;
use App\Models\AuditTrail;

class DeleteLeadAction
{
    public function execute(Lead $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Leads');
        return $model->delete(); 
    }
}