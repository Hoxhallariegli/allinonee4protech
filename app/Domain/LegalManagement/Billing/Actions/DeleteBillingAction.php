<?php

namespace App\Domain\LegalManagement\Billing\Actions;

use App\Models\LegalManagement\Billing;
use App\Models\AuditTrail;

class DeleteBillingAction
{
    public function execute(Billing $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Billings');
        return $model->delete(); 
    }
}