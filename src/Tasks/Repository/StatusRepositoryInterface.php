<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\StatusDto;
use App\Tasks\Entity\Status;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]
     */
    public function all(): array;

    /**
     *
     * @param int $id
     * @return Status|null
     */
    public function findOneById(int $id): ?Status;
}