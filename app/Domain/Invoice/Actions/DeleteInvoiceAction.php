<?php

namespace App\Domain\Invoice\Actions;

use App\Models\Invoice;
use App\Models\AuditTrail;

class DeleteInvoiceAction
{
    public function execute(Invoice $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Invoices');
        return $model->delete(); 
    }
}