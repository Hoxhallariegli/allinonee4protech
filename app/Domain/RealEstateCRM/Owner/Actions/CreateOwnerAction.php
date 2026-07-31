<?php

namespace App\Domain\RealEstateCRM\Owner\Actions;

use App\Models\RealEstateCRM\Owner;
use App\Domain\RealEstateCRM\Owner\DTOs\OwnerDTO;
use App\Models\AuditTrail;

class CreateOwnerAction
{
    public function execute(OwnerDTO $dto): Owner 
    {
        $item = Owner::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Owners');
        return $item;
    }
}