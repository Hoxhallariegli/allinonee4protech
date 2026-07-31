<?php

namespace App\Domain\CRM\Deal\DTOs;

class DealDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $contact_id,
        public readonly mixed $value,
        public readonly mixed $stage,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            contact_id: $data['contact_id'] ?? null,
            value: $data['value'] ?? null,
            stage: $data['stage'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'contact_id' => $this->contact_id,
            'value' => $this->value,
            'stage' => $this->stage,
        ]; }
}