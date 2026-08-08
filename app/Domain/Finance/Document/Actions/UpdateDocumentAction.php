<?php

namespace App\Domain\Finance\Document\Actions;

use App\Models\Finance\Document;
use App\Domain\Finance\Document\DTOs\DocumentDTO;
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