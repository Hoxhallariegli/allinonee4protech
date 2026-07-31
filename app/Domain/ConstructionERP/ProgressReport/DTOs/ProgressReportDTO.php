<?php

namespace App\Domain\ConstructionERP\ProgressReport\DTOs;

class ProgressReportDTO
{
    public function __construct(
        public readonly mixed $project_id,
        public readonly mixed $report_date,
        public readonly mixed $percentage,
    ) {}
    public static function fromArray(array $data): self { return new self(
            project_id: $data['project_id'] ?? null,
            report_date: $data['report_date'] ?? null,
            percentage: $data['percentage'] ?? null,
        ); }
    public function toArray(): array { return [
            'project_id' => $this->project_id,
            'report_date' => $this->report_date,
            'percentage' => $this->percentage,
        ]; }
}