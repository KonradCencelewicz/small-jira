<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\TaskDto;

interface TaskRepositoryInterface
{
    /**
     * @return TaskDto[]
     */
    public function allWithStatus(): array;
}