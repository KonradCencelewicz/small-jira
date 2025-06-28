<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Entity\Task;
use App\Tasks\Service\TaskStatusGrouperServiceInterface;

class TaskStatusGrouperService implements TaskStatusGrouperServiceInterface
{
    /**
     * @param Task[] $tasks
     * @return array<int, TaskDto[]>
     */
    public function groupByStatus(array $tasks): array
    {
        $grouped = [];

        foreach ($tasks as $task) {
            $statusId = $task->getStatus()->getId();
            
            if (!isset($grouped[$statusId])) {
                $grouped[$statusId] = [];
            }

            $grouped[$statusId][] = TaskDto::fromEntity($task);
        }

        return $grouped;
    }
}