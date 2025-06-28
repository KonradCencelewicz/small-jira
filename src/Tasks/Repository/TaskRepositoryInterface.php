<?php

namespace App\Tasks\Repository;

use App\Tasks\Entity\Task;

interface TaskRepositoryInterface
{
    /**
     * @return Task[]
     */
    public function allWithStatus(): array;

    public function findOneByIdWithStatus(int $id): ?Task;
}