<?php

namespace App\Domain\RealEstateCRM\Payment\Actions;

use App\Models\RealEstateCRM\Payment;
use App\Domain\RealEstateCRM\Payment\DTOs\PaymentDTO;
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