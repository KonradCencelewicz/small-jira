<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskCreateDto;
use App\Tasks\Dto\TaskDto;
use App\Tasks\Dto\TaskWithStatusDto;

interface TaskServiceInterface
{
    public function createTask(TaskCreateDto $task): TaskDto;
    public function updateTaskStatus(int $taskId, int $statusId): TaskWithStatusDto;
}
