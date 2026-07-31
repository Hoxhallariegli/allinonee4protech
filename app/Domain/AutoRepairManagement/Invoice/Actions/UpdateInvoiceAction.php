<?php

namespace App\Domain\AutoRepairManagement\Invoice\Actions;

use App\Models\AutoRepairManagement\Invoice;
use App\Domain\AutoRepairManagement\Invoice\DTOs\InvoiceDTO;
use App\Models\AuditTrail;

class UpdateInvoiceAction
{
    public function execute(Invoice $model, InvoiceDTO $dto): Invoice
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Invoices');
        $model->save();
        return $model->fresh();
    }
}