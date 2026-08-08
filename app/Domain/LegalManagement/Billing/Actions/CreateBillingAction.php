<?php

namespace App\Domain\LegalManagement\Billing\Actions;

use App\Models\LegalManagement\Billing;
use App\Domain\LegalManagement\Billing\DTOs\BillingDTO;
use App\Models\AuditTrail;

class CreateBillingAction
{
    public function execute(BillingDTO $dto): Billing 
    {
        $item = Billing::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Billings');
        return $item;
    }
}