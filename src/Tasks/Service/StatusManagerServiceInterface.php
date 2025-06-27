<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\StatusDto;

interface StatusManagerServiceInterface
{
    public function createStatus(string $value, int $sequence): StatusDto;
}
