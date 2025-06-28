<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Dto\TaskWithStatusDto;

interface TaskRepositoryInterface
{
    /**
     * @return TaskDto[]
     */
    public function allWithStatus(): array;

    public function findOneByIdWithStatus(int $id): ?TaskWithStatusDto;
}