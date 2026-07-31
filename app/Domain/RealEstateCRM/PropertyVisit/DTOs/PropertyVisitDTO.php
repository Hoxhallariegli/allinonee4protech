<?php

namespace App\Domain\RealEstateCRM\PropertyVisit\DTOs;

class PropertyVisitDTO
{
    public function __construct(
        public readonly mixed $property_id,
        public readonly mixed $client_id,
        public readonly mixed $visit_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            property_id: $data['property_id'] ?? null,
            client_id: $data['client_id'] ?? null,
            visit_date: $data['visit_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'visit_date' => $this->visit_date,
        ]; }
}