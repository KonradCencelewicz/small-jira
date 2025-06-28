<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\StatusDto;
use App\Tasks\Entity\Status;

interface StatusRepositoryInterface
{
    /**
     * @return StatusDto[]
     */
    public function all(): array;

    /**
     *
     * @param int $id
     * @return Status|null
     */
    public function findOneById(int $id): ?Status;
}