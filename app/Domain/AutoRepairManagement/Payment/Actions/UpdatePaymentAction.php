<?php

namespace App\Domain\AutoRepairManagement\Payment\Actions;

use App\Models\AutoRepairManagement\Payment;
use App\Domain\AutoRepairManagement\Payment\DTOs\PaymentDTO;
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