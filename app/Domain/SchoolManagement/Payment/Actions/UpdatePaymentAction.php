<?php

namespace App\Domain\SchoolManagement\Payment\Actions;

use App\Models\SchoolManagement\Payment;
use App\Domain\SchoolManagement\Payment\DTOs\PaymentDTO;
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