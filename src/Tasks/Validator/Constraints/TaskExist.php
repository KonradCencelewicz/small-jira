<?php

namespace App\Tasks\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute] 
class TaskExist extends Constraint
{
    public string $message = 'Task z id "{{ id }}" nie istnieje.';
}