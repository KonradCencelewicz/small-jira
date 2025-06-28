<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\StatusDto;

interface StatusRepositoryInterface
{
    /**
     * @return StatusDto[]
     */
    public function all(): array;
}