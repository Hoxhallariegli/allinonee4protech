<?php

namespace App\Domain\ConstructionERP\Payment\Actions;

use App\Models\ConstructionERP\Payment;
use App\Domain\ConstructionERP\Payment\DTOs\PaymentDTO;
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