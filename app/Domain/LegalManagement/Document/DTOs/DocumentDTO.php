<?php

namespace App\Domain\LegalManagement\Document\DTOs;

class DocumentDTO
{
    public function __construct(
        public readonly mixed $case_id,
        public readonly mixed $title,
        public readonly mixed $file_path,
    ) {}
    public static function fromArray(array $data): self { return new self(
            case_id: $data['case_id'] ?? null,
            title: $data['title'] ?? null,
            file_path: $data['file_path'] ?? null,
        ); }
    public function toArray(): array { return [
            'case_id' => $this->case_id,
            'title' => $this->title,
            'file_path' => $this->file_path,
        ]; }
}