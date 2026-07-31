<?php

namespace App\Domain\RealEstateCRM\Owner\Actions;

use App\Models\RealEstateCRM\Owner;
use App\Models\AuditTrail;

class DeleteOwnerAction
{
    public function execute(Owner $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Owners');
        return $model->delete(); 
    }
}