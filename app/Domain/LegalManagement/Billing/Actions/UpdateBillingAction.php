<?php

namespace App\Domain\LegalManagement\Billing\Actions;

use App\Models\LegalManagement\Billing;
use App\Domain\LegalManagement\Billing\DTOs\BillingDTO;
use App\Models\AuditTrail;

class UpdateBillingAction
{
    public function execute(Billing $model, BillingDTO $dto): Billing
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Billings');
        $model->save();
        return $model->fresh();
    }
}