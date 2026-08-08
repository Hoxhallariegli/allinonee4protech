<?php

namespace App\Domain\CRM\Interaction\DTOs;

class InteractionDTO
{
    public function __construct(
        public readonly mixed $contact_id,
        public readonly mixed $type,
        public readonly mixed $notes,
    ) {}
    public static function fromArray(array $data): self { return new self(
            contact_id: $data['contact_id'] ?? null,
            type: $data['type'] ?? null,
            notes: $data['notes'] ?? null,
        ); }
    public function toArray(): array { return [
            'contact_id' => $this->contact_id,
            'type' => $this->type,
            'notes' => $this->notes,
        ]; }
}