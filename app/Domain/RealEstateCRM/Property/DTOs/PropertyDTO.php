<?php

namespace App\Domain\RealEstateCRM\Property\DTOs;

class PropertyDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $owner_id,
        public readonly mixed $agent_id,
        public readonly mixed $price,
        public readonly mixed $type,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            owner_id: $data['owner_id'] ?? null,
            agent_id: $data['agent_id'] ?? null,
            price: $data['price'] ?? null,
            type: $data['type'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'owner_id' => $this->owner_id,
            'agent_id' => $this->agent_id,
            'price' => $this->price,
            'type' => $this->type,
            'photo' => $this->photo,
        ]; }
}