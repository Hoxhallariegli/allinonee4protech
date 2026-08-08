<?php

namespace App\Domain\LegalManagement\LegalCase\Actions;

use App\Models\LegalManagement\LegalCase;
use App\Domain\LegalManagement\LegalCase\DTOs\LegalCaseDTO;
use App\Models\AuditTrail;

class UpdateLegalCaseAction
{
    public function execute(LegalCase $model, LegalCaseDTO $dto): LegalCase
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'LegalCases');
        $model->save();
        return $model->fresh();
    }
}