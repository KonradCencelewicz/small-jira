<?php

namespace App\Tasks\Repository;

use App\Tasks\Entity\Task;

interface TaskRepositoryInterface
{
    /**
     * @return Task[]
     */
    public function all(): array;

    /**
     * @return Task[]
     */
    public function allWithParent(): array;

    public function findOneById(int $id): ?Task;

    public function findTaskWithParent(int $taskId): ?Task;

    public function isRootTask(int $id): bool;
        
    public function taskExist(int $id): bool;
}
