<?php

namespace App\Domain\AutoRepairManagement\JobCardService\DTOs;

class JobCardServiceDTO
{
    public function __construct(
        public readonly mixed $job_card_id,
        public readonly mixed $service_id,
        public readonly mixed $quantity,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            job_card_id: $data['job_card_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'job_card_id' => $this->job_card_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]; }
}