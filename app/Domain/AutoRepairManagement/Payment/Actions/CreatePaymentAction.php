<?php

namespace App\Domain\AutoRepairManagement\Payment\Actions;

use App\Models\AutoRepairManagement\Payment;
use App\Domain\AutoRepairManagement\Payment\DTOs\PaymentDTO;
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