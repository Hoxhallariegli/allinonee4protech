<?php

namespace App\Domain\GymManagement\Trainer\DTOs;

class TrainerDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $specialization,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            specialization: $data['specialization'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'specialization' => $this->specialization,
            'photo' => $this->photo,
        ]; }
}