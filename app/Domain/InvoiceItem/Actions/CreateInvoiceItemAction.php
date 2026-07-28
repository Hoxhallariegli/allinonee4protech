<?php

namespace App\Domain\InvoiceItem\Actions;

use App\Models\InvoiceItem;
use App\Domain\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Models\AuditTrail;

class CreateInvoiceItemAction
{
    public function execute(InvoiceItemDTO $dto): InvoiceItem 
    {
        $item = InvoiceItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'InvoiceItems');
        return $item;
    }
}