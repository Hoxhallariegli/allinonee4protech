<?php

namespace App\Domain\Finance\Document\DTOs;

class DocumentDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $file_path,
        public readonly mixed $file_type,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            file_path: $data['file_path'] ?? null,
            file_type: $data['file_type'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'file_path' => $this->file_path,
            'file_type' => $this->file_type,
        ]; }
}