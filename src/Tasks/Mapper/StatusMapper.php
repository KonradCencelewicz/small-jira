<?php

namespace App\Tasks\Mapper;

use App\Tasks\Entity\Status;
use App\Tasks\Dto\StatusDto;

class StatusMapper implements StatusMapperInterface
{
    /**
     * Map Status dto to statusId and return array
     *
     * @param Status[] $statuses
     * @return StatusDto[] Key: statusId, value: StatusDto
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