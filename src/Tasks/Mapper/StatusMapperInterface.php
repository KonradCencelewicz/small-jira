<?php

namespace App\Tasks\Mapper;

use App\Tasks\Entity\Status;
use App\Tasks\Dto\StatusDto;

interface StatusMapperInterface
{
    /**
     *
     * @param Status[]
     * @return StatusDto[]
     */
    public function mapById(array $statuses): array;
}