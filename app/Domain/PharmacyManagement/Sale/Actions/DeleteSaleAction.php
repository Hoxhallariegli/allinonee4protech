<?php

namespace App\Domain\PharmacyManagement\Sale\Actions;

use App\Models\PharmacyManagement\Sale;
use App\Models\AuditTrail;

class DeleteSaleAction
{
    public function execute(Sale $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Sales');
        return $model->delete(); 
    }
}