<?php

namespace App\Domain\BerberApp\Barber\DTOs;

class BarberDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $photo,
        public readonly mixed $specialization,
        public readonly mixed $active,
        public readonly mixed $user_id = null,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            photo: $data['photo'] ?? null,
            specialization: $data['specialization'] ?? null,
            active: $data['active'] ?? null,
            user_id: $data['user_id'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'photo' => $this->photo,
            'specialization' => $this->specialization,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ]; }
}
