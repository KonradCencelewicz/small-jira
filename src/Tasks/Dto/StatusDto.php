<?php

namespace App\Tasks\Dto;

use App\Tasks\Entity\Status;

readonly class StatusDto
{
    public function __construct(
        public ?int $id,
        public string $label,
        public int $sequence,
        public string $color,
    ) {}

    public static function fromEntity(Status $status): self
    {
        return new self(
            $status->getId(),
            $status->getLabel(),
            $status->getSequence(),
            $status->getColor()
        );
    }
}