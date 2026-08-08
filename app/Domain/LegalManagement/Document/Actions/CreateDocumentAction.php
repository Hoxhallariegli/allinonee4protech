<?php

namespace App\Domain\LegalManagement\Document\Actions;

use App\Models\LegalManagement\Document;
use App\Domain\LegalManagement\Document\DTOs\DocumentDTO;
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