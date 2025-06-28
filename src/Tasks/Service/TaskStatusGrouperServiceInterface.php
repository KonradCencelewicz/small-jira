<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\StatusDto;

interface TaskStatusGrouperServiceInterface
{
    public function groupByStatus(array $tasks): array;
}
