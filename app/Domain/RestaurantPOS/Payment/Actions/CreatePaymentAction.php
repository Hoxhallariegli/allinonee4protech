<?php

namespace App\Domain\RestaurantPOS\Payment\Actions;

use App\Models\RestaurantPOS\Payment;
use App\Domain\RestaurantPOS\Payment\DTOs\PaymentDTO;
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