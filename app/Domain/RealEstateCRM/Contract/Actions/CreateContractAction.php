<?php

namespace App\Domain\RealEstateCRM\Contract\Actions;

use App\Models\RealEstateCRM\Contract;
use App\Domain\RealEstateCRM\Contract\DTOs\ContractDTO;
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