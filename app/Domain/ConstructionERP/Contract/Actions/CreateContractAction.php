<?php

namespace App\Domain\ConstructionERP\Contract\Actions;

use App\Models\ConstructionERP\Contract;
use App\Domain\ConstructionERP\Contract\DTOs\ContractDTO;
use App\Models\AuditTrail;

class CreateContractAction
{
    public function execute(ContractDTO $dto): Contract 
    {
        $item = Contract::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Contracts');
        return $item;
    }
}