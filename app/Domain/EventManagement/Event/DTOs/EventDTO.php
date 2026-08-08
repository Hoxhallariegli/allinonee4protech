<?php

namespace App\Domain\EventManagement\Event\DTOs;

class EventDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $organizer_id,
        public readonly mixed $event_date,
        public readonly mixed $location,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            organizer_id: $data['organizer_id'] ?? null,
            event_date: $data['event_date'] ?? null,
            location: $data['location'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'organizer_id' => $this->organizer_id,
            'event_date' => $this->event_date,
            'location' => $this->location,
        ]; }
}