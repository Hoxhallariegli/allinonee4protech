<?php

namespace App\Domain\RealEstateCRM\Payment\DTOs;

class PaymentDTO
{
    public function __construct(
        public readonly mixed $client_id,
        public readonly mixed $amount,
        public readonly mixed $payment_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            client_id: $data['client_id'] ?? null,
            amount: $data['amount'] ?? null,
            payment_date: $data['payment_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'client_id' => $this->client_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
        ]; }
}