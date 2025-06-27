<?php

namespace App\Tasks\Enum;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case DONE = 'done';
    case REJECTED = 'rejected';
}