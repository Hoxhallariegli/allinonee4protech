<?php

namespace App\Domain\Finance\Expense\DTOs;

class ExpenseDTO
{
    public function __construct(
        public readonly mixed $amount,
        public readonly mixed $date,
        public readonly mixed $category_id,
        public readonly mixed $attachment_file,
    ) {}
    public static function fromArray(array $data): self { return new self(
            amount: $data['amount'] ?? null,
            date: $data['date'] ?? null,
            category_id: $data['category_id'] ?? null,
            attachment_file: $data['attachment_file'] ?? null,
        ); }
    public function toArray(): array { return [
            'amount' => $this->amount,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'attachment_file' => $this->attachment_file,
        ]; }
}