<?php

namespace App\Domain\Finance\Document\Actions;

use App\Models\Finance\Document;
use App\Domain\Finance\Document\DTOs\DocumentDTO;
use App\Models\AuditTrail;

class CreateDocumentAction
{
    public function execute(DocumentDTO $dto): Document 
    {
        $item = Document::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Documents');
        return $item;
    }
}