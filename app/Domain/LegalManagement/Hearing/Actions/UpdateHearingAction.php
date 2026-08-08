<?php

namespace App\Domain\LegalManagement\Hearing\Actions;

use App\Models\LegalManagement\Hearing;
use App\Domain\LegalManagement\Hearing\DTOs\HearingDTO;
use App\Models\AuditTrail;

class UpdateHearingAction
{
    public function execute(Hearing $model, HearingDTO $dto): Hearing
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Hearings');
        $model->save();
        return $model->fresh();
    }
}