<?php

namespace App\Domain\SchoolManagement\Payment\Actions;

use App\Models\SchoolManagement\Payment;
use App\Models\AuditTrail;

class DeletePaymentAction
{
    public function execute(Payment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Payments');
        return $model->delete(); 
    }
}