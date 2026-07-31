<?php

namespace App\Domain\RealEstateCRM\Contract\DTOs;

class ContractDTO
{
    public function __construct(
        public readonly mixed $property_id,
        public readonly mixed $client_id,
        public readonly mixed $amount,
    ) {}
    public static function fromArray(array $data): self { return new self(
            property_id: $data['property_id'] ?? null,
            client_id: $data['client_id'] ?? null,
            amount: $data['amount'] ?? null,
        ); }
    public function toArray(): array { return [
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'amount' => $this->amount,
        ]; }
}