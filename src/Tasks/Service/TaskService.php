<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Entity\Task;
use App\Tasks\Dto\StatusDto;
use App\Tasks\Dto\TaskCreateDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Tasks\Service\TaskServiceInterface;
use App\Tasks\Repository\TaskRepositoryInterface;
use App\Tasks\Repository\StatusRepositoryInterface;

final class TaskService implements TaskServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private TaskRepositoryInterface $taskRepository,
        private StatusRepositoryInterface $statusRepository,
    ) {}

    public function createTask(TaskCreateDto $dto): TaskDto
    {
        $task = new Task();
        $task->setTitle($dto->title);
        $task->setDescription($dto->description);
        $task->setDeadline($dto->deadline);

        $status = $this->statusRepository->findOneById($dto->statusId);
        $task->setStatus($status);

        if ($dto->parentTaskId) {
            $parentTask = $this->taskRepository->findOneById($dto->parentTaskId);
            $task->setParentTask($parentTask);
        }

        $this->em->persist($task);
        $this->em->flush();

        return TaskDto::fromEntity($task);
    }

    public function updateTask(TaskDto $dto): TaskDto
    {
        $task = $this->taskRepository->findOneById($dto->id);
        $task->setTitle($dto->title);
        $task->setDescription($dto->description);
        $task->setDeadline($dto->deadline);

        $status = $this->statusRepository->findOneById($dto->statusId);
        $task->setStatus($status);

        if ($dto->parentTaskId) {
            $parentTask = $this->taskRepository->findOneById($dto->parentTaskId);
            $task->setParentTask($parentTask);
        }

        $this->em->persist($task);
        $this->em->flush();

        return TaskDto::fromEntity($task);
    }

    public function updateTaskStatus(int $taskId, int $statusId): array
    {
        $task = $this->taskRepository->findOneById($taskId);
        $status = $this->statusRepository->findOneById($statusId);

        $task->setStatus($status);

        $this->em->persist($task);
        $this->em->flush();

        return [TaskDto::fromEntity($task), StatusDto::fromEntity($status)];
    }
}