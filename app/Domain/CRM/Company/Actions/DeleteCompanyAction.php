<?php

namespace App\Domain\CRM\Company\Actions;

use App\Models\CRM\Company;
use App\Models\AuditTrail;

class DeleteCompanyAction
{
    public function execute(Company $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Companies');
        return $model->delete(); 
    }
}