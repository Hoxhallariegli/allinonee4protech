<?php

namespace App\Domain\RealEstateCRM\Contract\Actions;

use App\Models\RealEstateCRM\Contract;
use App\Domain\RealEstateCRM\Contract\DTOs\ContractDTO;
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