<?php

namespace App\Domain\Finance\Account\DTOs;

class AccountDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $type,
        public readonly mixed $balance,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            type: $data['type'] ?? null,
            balance: $data['balance'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
        ]; }
}