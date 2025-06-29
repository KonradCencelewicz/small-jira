<?php

namespace App\Tasks\Validator\Constraints;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsRootTaskValidator extends ConstraintValidator
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

        $isRootTask = $this->taskRepository->isRootTask($value);

        if (!$isRootTask) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ id }}', $value)
                ->addViolation();
        }
    }
}
 