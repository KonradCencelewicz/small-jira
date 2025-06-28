<?php

namespace App\Tasks\Service;

use App\Tasks\Entity\Task;
use App\Tasks\Dto\TaskWithStatusDto;
use App\Tasks\Service\TaskStatusGrouperServiceInterface;

class TaskStatusGrouperService implements TaskStatusGrouperServiceInterface
{
    /**
     * @param Task[] $tasks
     * @return array<int, TaskWithStatusDto[]>
     */
    public function groupByStatus(array $tasks): array
    {
        $grouped = [];

        foreach ($tasks as $task) {
            $statusId = $task->getStatus()->getId();
            
            if (!isset($grouped[$statusId])) {
                $grouped[$statusId] = [];
            }

            $grouped[$statusId][] = TaskWithStatusDto::fromEntity($task);
        }

        return $grouped;
    }
}