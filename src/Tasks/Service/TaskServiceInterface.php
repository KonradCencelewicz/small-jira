<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskCreateDto;
use App\Tasks\Dto\TaskDto;

interface TaskServiceInterface
{
    public function createTask(TaskCreateDto $task): TaskDto;
}