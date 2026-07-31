<?php

namespace App\Domain\CRM\Task\DTOs;

class TaskDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $deal_id,
        public readonly mixed $due_date,
        public readonly mixed $completed,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            deal_id: $data['deal_id'] ?? null,
            due_date: $data['due_date'] ?? null,
            completed: $data['completed'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'deal_id' => $this->deal_id,
            'due_date' => $this->due_date,
            'completed' => $this->completed,
        ]; }
}