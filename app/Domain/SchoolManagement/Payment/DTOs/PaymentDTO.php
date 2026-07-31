<?php

namespace App\Domain\SchoolManagement\Payment\DTOs;

class PaymentDTO
{
    public function __construct(
        public readonly mixed $student_id,
        public readonly mixed $amount,
        public readonly mixed $payment_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            student_id: $data['student_id'] ?? null,
            amount: $data['amount'] ?? null,
            payment_date: $data['payment_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'student_id' => $this->student_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
        ]; }
}