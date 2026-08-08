<?php

namespace App\Domain\RealEstateCRM\Agent\DTOs;

class AgentDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $phone,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            phone: $data['phone'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]; }
}