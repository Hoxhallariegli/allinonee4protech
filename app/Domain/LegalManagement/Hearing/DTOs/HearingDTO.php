<?php

namespace App\Domain\LegalManagement\Hearing\DTOs;

class HearingDTO
{
    public function __construct(
        public readonly mixed $case_id,
        public readonly mixed $hearing_date,
        public readonly mixed $location,
    ) {}
    public static function fromArray(array $data): self { return new self(
            case_id: $data['case_id'] ?? null,
            hearing_date: $data['hearing_date'] ?? null,
            location: $data['location'] ?? null,
        ); }
    public function toArray(): array { return [
            'case_id' => $this->case_id,
            'hearing_date' => $this->hearing_date,
            'location' => $this->location,
        ]; }
}