<?php

namespace App\Domain\RestaurantPOS\Payment\Actions;

use App\Models\RestaurantPOS\Payment;
use App\Domain\RestaurantPOS\Payment\DTOs\PaymentDTO;
use App\Models\AuditTrail;

class UpdatePaymentAction
{
    public function execute(Payment $model, PaymentDTO $dto): Payment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Payments');
        $model->save();
        return $model->fresh();
    }
}