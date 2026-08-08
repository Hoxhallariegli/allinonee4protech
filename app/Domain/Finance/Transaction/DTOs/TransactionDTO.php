<?php

namespace App\Domain\Finance\Transaction\DTOs;

class TransactionDTO
{
    public function __construct(
        public readonly mixed $account_id,
        public readonly mixed $category_id,
        public readonly mixed $amount,
        public readonly mixed $date,
        public readonly mixed $description,
    ) {}
    public static function fromArray(array $data): self { return new self(
            account_id: $data['account_id'] ?? null,
            category_id: $data['category_id'] ?? null,
            amount: $data['amount'] ?? null,
            date: $data['date'] ?? null,
            description: $data['description'] ?? null,
        ); }
    public function toArray(): array { return [
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,
        ]; }
}