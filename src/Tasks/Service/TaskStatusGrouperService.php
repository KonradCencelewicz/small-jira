<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Service\TaskStatusGrouperServiceInterface;

class TaskStatusGrouperService implements TaskStatusGrouperServiceInterface
{
    /**
     * @param TaskWithStatusDto[] $tasks
     * @return array<int, TaskDto[]> // gdzie key to statusId
     */
    public function groupByStatus(array $tasks): array
    {
        $grouped = [];

        foreach ($tasks as $task) {
            $statusId = $task->status->id;
            
            if (!isset($grouped[$statusId])) {
                $grouped[$statusId] = [];
            }

            $grouped[$statusId][] = $task;
        }

        return $grouped;
    }
}