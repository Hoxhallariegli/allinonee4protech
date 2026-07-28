<?php

namespace App\Domain\InvoiceItem\Actions;

use App\Models\InvoiceItem;
use App\Domain\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Models\AuditTrail;

class UpdateInvoiceItemAction
{
    public function execute(InvoiceItem $model, InvoiceItemDTO $dto): InvoiceItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'InvoiceItems');
        $model->save();
        return $model->fresh();
    }
}