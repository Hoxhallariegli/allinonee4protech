<?php

namespace App\Domain\RealEstateCRM\Property\DTOs;

class PropertyDTO
{
    public function __construct(
        public readonly mixed $title,
        public readonly mixed $owner_id,
        public readonly mixed $agent_id,
        public readonly mixed $no,
    ) {}
    public static function fromArray(array $data): self { return new self(
            title: $data['title'] ?? null,
            owner_id: $data['owner_id'] ?? null,
            agent_id: $data['agent_id'] ?? null,
            no: $data['no'] ?? null,
        ); }
    public function toArray(): array { return [
            'title' => $this->title,
            'owner_id' => $this->owner_id,
            'agent_id' => $this->agent_id,
            'no' => $this->no,
        ]; }
}