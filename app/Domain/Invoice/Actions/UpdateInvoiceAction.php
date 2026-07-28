<?php

namespace App\Domain\Invoice\Actions;

use App\Models\Invoice;
use App\Domain\Invoice\DTOs\InvoiceDTO;
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