<?php

namespace App\Domain\EventManagement\TicketType\DTOs;

class TicketTypeDTO
{
    public function __construct(
        public readonly mixed $event_id,
        public readonly mixed $name,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            event_id: $data['event_id'] ?? null,
            name: $data['name'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'event_id' => $this->event_id,
            'name' => $this->name,
            'price' => $this->price,
        ]; }
}