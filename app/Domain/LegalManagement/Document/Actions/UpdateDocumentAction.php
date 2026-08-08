<?php

namespace App\Domain\LegalManagement\Document\Actions;

use App\Models\LegalManagement\Document;
use App\Domain\LegalManagement\Document\DTOs\DocumentDTO;
use App\Models\AuditTrail;

class UpdateDocumentAction
{
    public function execute(Document $model, DocumentDTO $dto): Document
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Documents');
        $model->save();
        return $model->fresh();
    }
}