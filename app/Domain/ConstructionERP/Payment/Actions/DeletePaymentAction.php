<?php

namespace App\Domain\ConstructionERP\Payment\Actions;

use App\Models\ConstructionERP\Payment;
use App\Models\AuditTrail;

class DeletePaymentAction
{
    public function execute(Payment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Payments');
        return $model->delete(); 
    }
}