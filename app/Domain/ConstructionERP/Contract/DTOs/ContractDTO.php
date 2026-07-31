<?php

namespace App\Domain\ConstructionERP\Contract\DTOs;

class ContractDTO
{
    public function __construct(
        public readonly mixed $project_id,
        public readonly mixed $client_id,
        public readonly mixed $contract_date,
        public readonly mixed $amount,
    ) {}
    public static function fromArray(array $data): self { return new self(
            project_id: $data['project_id'] ?? null,
            client_id: $data['client_id'] ?? null,
            contract_date: $data['contract_date'] ?? null,
            amount: $data['amount'] ?? null,
        ); }
    public function toArray(): array { return [
            'project_id' => $this->project_id,
            'client_id' => $this->client_id,
            'contract_date' => $this->contract_date,
            'amount' => $this->amount,
        ]; }
}