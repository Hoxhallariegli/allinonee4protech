<?php

namespace App\Domain\Invoice\Actions;

use App\Models\Invoice;
use App\Domain\Invoice\DTOs\InvoiceDTO;
use App\Models\AuditTrail;

class CreateInvoiceAction
{
    public function execute(InvoiceDTO $dto): Invoice 
    {
        $item = Invoice::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Invoices');
        return $item;
    }
}