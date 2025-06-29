<?php

namespace App\Tasks\Mapper;

use App\Tasks\Entity\Status;
use App\Tasks\Dto\StatusDto;

class StatusMapper implements StatusMapperInterface
{
    /**
     * Mapuje tablicę encji Status na tablicę StatusDto z kluczami jako ID statusów.
     *
     * @param Status[] $statuses
     * @return StatusDto[] Klucz: ID statusu, wartość: StatusDto
     */
    public function mapById(array $statuses): array
    {
        $mapped = [];

        foreach ($statuses as $status) {
            $mapped[$status->getId()] = StatusDto::fromEntity($status);
        }

        return $mapped;
    }
}