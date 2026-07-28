<?php

namespace App\Domain\JobCardPart\DTOs;

class JobCardPartDTO
{
    public function __construct(
        public readonly mixed $job_card_id,
        public readonly mixed $part_id,
        public readonly mixed $quantity,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            job_card_id: $data['job_card_id'] ?? null,
            part_id: $data['part_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'job_card_id' => $this->job_card_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]; }
}