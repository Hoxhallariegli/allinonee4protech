<?php

namespace App\Domain\InvoiceItem\Actions;

use App\Models\InvoiceItem;
use App\Models\AuditTrail;

class DeleteInvoiceItemAction
{
    public function execute(InvoiceItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'InvoiceItems');
        return $model->delete(); 
    }
}