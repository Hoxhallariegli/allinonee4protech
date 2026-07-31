<?php

namespace App\Domain\CRM\Deal\Actions;

use App\Models\CRM\Deal;
use App\Domain\CRM\Deal\DTOs\DealDTO;
use App\Models\AuditTrail;

class CreateDealAction
{
    public function execute(DealDTO $dto): Deal 
    {
        $item = Deal::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Deals');
        return $item;
    }
}