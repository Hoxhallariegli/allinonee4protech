<?php

namespace App\Domain\VehicleDocument\DTOs;

class VehicleDocumentDTO
{
    public function __construct(
        public readonly mixed $type,
        public readonly mixed $document,
        public readonly mixed $vehicle_id,
    ) {}
    public static function fromArray(array $data): self { return new self(
            type: $data['type'] ?? null,
            document: $data['document'] ?? null,
            vehicle_id: $data['vehicle_id'] ?? null,
        ); }
    public function toArray(): array { return [
            'type' => $this->type,
            'document' => $this->document,
            'vehicle_id' => $this->vehicle_id,
        ]; }
}