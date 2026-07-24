<?php

namespace App\Domain\Category\DTOs;

class CategoryDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $slug,
        public readonly ?string $no,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            slug: $data['slug'] ?? null,
            no: $data['no'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'slug' => $this->slug,
            'no' => $this->no,
        ]; }
}