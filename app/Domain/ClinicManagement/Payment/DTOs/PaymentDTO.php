<?php

namespace App\Domain\ClinicManagement\Payment\DTOs;

class PaymentDTO
{
    public function __construct(
        public readonly mixed $patient_id,
        public readonly mixed $invoice_id,
        public readonly mixed $amount,
        public readonly mixed $payment_method,
    ) {}
    public static function fromArray(array $data): self { return new self(
            patient_id: $data['patient_id'] ?? null,
            invoice_id: $data['invoice_id'] ?? null,
            amount: $data['amount'] ?? null,
            payment_method: $data['payment_method'] ?? null,
        ); }
    public function toArray(): array { return [
            'patient_id' => $this->patient_id,
            'invoice_id' => $this->invoice_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
        ]; }
}