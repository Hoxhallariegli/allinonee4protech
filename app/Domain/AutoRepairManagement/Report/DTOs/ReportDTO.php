<?php

namespace App\Domain\AutoRepairManagement\Report\DTOs;

class ReportDTO
{
    public function __construct(
        public readonly mixed $report_type,
        public readonly mixed $report_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            report_type: $data['report_type'] ?? null,
            report_date: $data['report_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'report_type' => $this->report_type,
            'report_date' => $this->report_date,
        ]; }
}