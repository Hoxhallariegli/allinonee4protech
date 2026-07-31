<?php

namespace App\Domain\RestaurantPOS\Payment\Actions;

use App\Models\RestaurantPOS\Payment;
use App\Models\AuditTrail;

class DeletePaymentAction
{
    public function execute(Payment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Payments');
        return $model->delete(); 
    }
}