<?php

namespace App\Domain\ConstructionERP\HeavyMachinery\DTOs;

class HeavyMachineryDTO
{
    public function __construct(
        public readonly mixed $project_id,
        public readonly mixed $name,
    ) {}
    public static function fromArray(array $data): self { return new self(
            project_id: $data['project_id'] ?? null,
            name: $data['name'] ?? null,
        ); }
    public function toArray(): array { return [
            'project_id' => $this->project_id,
            'name' => $this->name,
        ]; }
}