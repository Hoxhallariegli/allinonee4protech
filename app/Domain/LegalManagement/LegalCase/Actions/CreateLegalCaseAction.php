<?php

namespace App\Domain\LegalManagement\LegalCase\Actions;

use App\Models\LegalManagement\LegalCase;
use App\Domain\LegalManagement\LegalCase\DTOs\LegalCaseDTO;
use App\Models\AuditTrail;

class CreateLegalCaseAction
{
    public function execute(LegalCaseDTO $dto): LegalCase 
    {
        $item = LegalCase::create($dto->toArray());
        AuditTrail::log($item, 'create', 'LegalCases');
        return $item;
    }
}