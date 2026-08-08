<?php

namespace App\Domain\Finance\Document\Actions;

use App\Models\Finance\Document;
use App\Models\AuditTrail;

class DeleteDocumentAction
{
    public function execute(Document $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Documents');
        return $model->delete(); 
    }
}