<?php

namespace App\Domain\ClinicManagement\Payment\Actions;

use App\Models\ClinicManagement\Payment;
use App\Domain\ClinicManagement\Payment\DTOs\PaymentDTO;
use App\Models\AuditTrail;

class CreatePaymentAction
{
    public function execute(PaymentDTO $dto): Payment 
    {
        $item = Payment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Payments');
        return $item;
    }
}