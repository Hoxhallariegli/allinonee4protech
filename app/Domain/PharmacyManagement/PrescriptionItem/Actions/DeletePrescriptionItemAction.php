<?php

namespace App\Domain\PharmacyManagement\PrescriptionItem\Actions;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Models\AuditTrail;

class DeletePrescriptionItemAction
{
    public function execute(PrescriptionItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PrescriptionItems');
        return $model->delete(); 
    }
}