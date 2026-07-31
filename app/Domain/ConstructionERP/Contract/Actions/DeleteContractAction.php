<?php

namespace App\Domain\ConstructionERP\Contract\Actions;

use App\Models\ConstructionERP\Contract;
use App\Models\AuditTrail;

class DeleteContractAction
{
    public function execute(Contract $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Contracts');
        return $model->delete(); 
    }
}