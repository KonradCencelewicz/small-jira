<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Entity\Task;
use App\Tasks\Dto\TaskCreateDto;

interface TaskServiceInterface
{
    public function createTask(TaskCreateDto $task, ?Task $parentTask): TaskDto;
    public function updateTaskStatus(int $taskId, int $statusId): TaskDto;
}
