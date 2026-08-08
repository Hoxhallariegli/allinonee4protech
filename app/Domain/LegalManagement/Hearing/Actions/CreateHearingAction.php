<?php

namespace App\Domain\LegalManagement\Hearing\Actions;

use App\Models\LegalManagement\Hearing;
use App\Domain\LegalManagement\Hearing\DTOs\HearingDTO;
use App\Models\AuditTrail;

class CreateHearingAction
{
    public function execute(HearingDTO $dto): Hearing 
    {
        $item = Hearing::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Hearings');
        return $item;
    }
}