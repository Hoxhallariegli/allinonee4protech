<?php

namespace App\Domain\RealEstateCRM\Contract\Actions;

use App\Models\RealEstateCRM\Contract;
use App\Models\AuditTrail;

class DeleteContractAction
{
    public function execute(Contract $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Contracts');
        return $model->delete(); 
    }
}