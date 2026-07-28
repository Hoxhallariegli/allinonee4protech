<?php

namespace App\Domain\Invoice\DTOs;

class InvoiceDTO
{
    public function __construct(
        public readonly mixed $job_card_id,
        public readonly mixed $invoice_date,
        public readonly mixed $total,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            job_card_id: $data['job_card_id'] ?? null,
            invoice_date: $data['invoice_date'] ?? null,
            total: $data['total'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'job_card_id' => $this->job_card_id,
            'invoice_date' => $this->invoice_date,
            'total' => $this->total,
            'status' => $this->status,
        ]; }
}