<?php

namespace App\Domain\Finance\Budget\DTOs;

class BudgetDTO
{
    public function __construct(
        public readonly mixed $category_id,
        public readonly mixed $amount,
        public readonly mixed $period,
    ) {}
    public static function fromArray(array $data): self { return new self(
            category_id: $data['category_id'] ?? null,
            amount: $data['amount'] ?? null,
            period: $data['period'] ?? null,
        ); }
    public function toArray(): array { return [
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'period' => $this->period,
        ]; }
}