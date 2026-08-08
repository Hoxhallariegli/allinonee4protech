<?php

namespace App\Domain\ConstructionERP\Payment\Actions;

use App\Models\ConstructionERP\Payment;
use App\Domain\ConstructionERP\Payment\DTOs\PaymentDTO;
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