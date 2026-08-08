<?php

namespace App\Domain\LegalManagement\LegalCase\Actions;

use App\Models\LegalManagement\LegalCase;
use App\Models\AuditTrail;

class DeleteLegalCaseAction
{
    public function execute(LegalCase $model): bool 
    {
        AuditTrail::log($model, 'delete', 'LegalCases');
        return $model->delete(); 
    }
}