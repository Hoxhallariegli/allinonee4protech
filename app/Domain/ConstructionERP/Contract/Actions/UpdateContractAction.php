<?php

namespace App\Domain\ConstructionERP\Contract\Actions;

use App\Models\ConstructionERP\Contract;
use App\Domain\ConstructionERP\Contract\DTOs\ContractDTO;
use App\Models\AuditTrail;

class UpdateContractAction
{
    public function execute(Contract $model, ContractDTO $dto): Contract
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Contracts');
        $model->save();
        return $model->fresh();
    }
}