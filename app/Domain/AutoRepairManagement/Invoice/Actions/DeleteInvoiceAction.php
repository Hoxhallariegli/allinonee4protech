<?php

namespace App\Domain\AutoRepairManagement\Invoice\Actions;

use App\Models\AutoRepairManagement\Invoice;
use App\Models\AuditTrail;

class DeleteInvoiceAction
{
    public function execute(Invoice $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Invoices');
        return $model->delete(); 
    }
}