<?php

namespace App\Tasks\Validator\Constraints;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaskExistValidator extends ConstraintValidator
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value || 0 === $value) {
            return;
        }

        $taskExist = $this->taskRepository->taskExist($value);

        if (!$taskExist) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ id }}', $value)
                ->addViolation();
        }
    }
}
 