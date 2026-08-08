<?php

namespace App\Domain\RealEstateCRM\Payment\Actions;

use App\Models\RealEstateCRM\Payment;
use App\Models\AuditTrail;

class DeletePaymentAction
{
    public function execute(Payment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Payments');
        return $model->delete(); 
    }
}