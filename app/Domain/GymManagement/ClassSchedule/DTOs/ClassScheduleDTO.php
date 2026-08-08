<?php

namespace App\Domain\GymManagement\ClassSchedule\DTOs;

class ClassScheduleDTO
{
    public function __construct(
        public readonly mixed $class_name,
        public readonly mixed $trainer_id,
        public readonly mixed $start_time,
        public readonly mixed $end_time,
    ) {}
    public static function fromArray(array $data): self { return new self(
            class_name: $data['class_name'] ?? null,
            trainer_id: $data['trainer_id'] ?? null,
            start_time: $data['start_time'] ?? null,
            end_time: $data['end_time'] ?? null,
        ); }
    public function toArray(): array { return [
            'class_name' => $this->class_name,
            'trainer_id' => $this->trainer_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]; }
}