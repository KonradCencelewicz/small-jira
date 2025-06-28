<?php

namespace App\Tasks\Service;

interface TaskStatusGrouperServiceInterface
{
    public function groupByStatus(array $tasks): array;
}
