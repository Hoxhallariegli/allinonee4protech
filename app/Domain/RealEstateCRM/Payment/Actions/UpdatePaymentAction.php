<?php

namespace App\Domain\RealEstateCRM\Payment\Actions;

use App\Models\RealEstateCRM\Payment;
use App\Domain\RealEstateCRM\Payment\DTOs\PaymentDTO;
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