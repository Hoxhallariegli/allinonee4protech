<?php

namespace App\Domain\CRM\Deal\Actions;

use App\Models\CRM\Deal;
use App\Models\AuditTrail;

class DeleteDealAction
{
    public function execute(Deal $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Deals');
        return $model->delete(); 
    }
}