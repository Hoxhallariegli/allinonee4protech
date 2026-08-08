<?php

namespace App\Domain\Finance\Category\DTOs;

class CategoryDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $type,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            type: $data['type'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'type' => $this->type,
        ]; }
}