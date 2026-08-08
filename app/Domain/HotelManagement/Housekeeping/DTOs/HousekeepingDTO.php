<?php

namespace App\Domain\HotelManagement\Housekeeping\DTOs;

class HousekeepingDTO
{
    public function __construct(
        public readonly mixed $room_id,
        public readonly mixed $task,
        public readonly mixed $is_completed,
    ) {}
    public static function fromArray(array $data): self { return new self(
            room_id: $data['room_id'] ?? null,
            task: $data['task'] ?? null,
            is_completed: $data['is_completed'] ?? null,
        ); }
    public function toArray(): array { return [
            'room_id' => $this->room_id,
            'task' => $this->task,
            'is_completed' => $this->is_completed,
        ]; }
}