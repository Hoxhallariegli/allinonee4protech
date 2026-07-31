<?php

namespace App\Domain\AutoRepairManagement\InvoiceItem\Actions;

use App\Models\AutoRepairManagement\InvoiceItem;
use App\Models\AuditTrail;

class DeleteInvoiceItemAction
{
    public function execute(InvoiceItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'InvoiceItems');
        return $model->delete(); 
    }
}