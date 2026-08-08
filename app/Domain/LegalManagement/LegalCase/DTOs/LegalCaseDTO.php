<?php

namespace App\Domain\LegalManagement\LegalCase\DTOs;

class LegalCaseDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $client_id,
        public readonly mixed $status,
        public readonly mixed $description,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            client_id: $data['client_id'] ?? null,
            status: $data['status'] ?? null,
            description: $data['description'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'description' => $this->description,
        ]; }
}