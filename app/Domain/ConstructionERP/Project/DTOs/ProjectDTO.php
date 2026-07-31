<?php

namespace App\Domain\ConstructionERP\Project\DTOs;

class ProjectDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $client_id,
        public readonly mixed $start_date,
        public readonly mixed $budget,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            client_id: $data['client_id'] ?? null,
            start_date: $data['start_date'] ?? null,
            budget: $data['budget'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'client_id' => $this->client_id,
            'start_date' => $this->start_date,
            'budget' => $this->budget,
            'status' => $this->status,
        ]; }
}