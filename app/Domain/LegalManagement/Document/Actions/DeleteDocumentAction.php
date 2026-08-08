<?php

namespace App\Domain\LegalManagement\Document\Actions;

use App\Models\LegalManagement\Document;
use App\Models\AuditTrail;

class DeleteDocumentAction
{
    public function execute(Document $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Documents');
        return $model->delete(); 
    }
}