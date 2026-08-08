<?php

namespace App\Domain\PharmacyManagement\Medicine\Actions;

use App\Models\PharmacyManagement\Medicine;
use App\Models\AuditTrail;

class DeleteMedicineAction
{
    public function execute(Medicine $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Medicines');
        return $model->delete(); 
    }
}