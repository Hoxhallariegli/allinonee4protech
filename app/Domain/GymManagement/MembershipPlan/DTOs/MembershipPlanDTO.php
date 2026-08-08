<?php

namespace App\Domain\GymManagement\MembershipPlan\DTOs;

class MembershipPlanDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $price,
        public readonly mixed $duration_days,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            price: $data['price'] ?? null,
            duration_days: $data['duration_days'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
        ]; }
}