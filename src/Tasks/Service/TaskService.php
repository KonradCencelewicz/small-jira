<?php

namespace App\Tasks\Service;

use App\Tasks\Dto\TaskDto;
use App\Tasks\Entity\Task;
use App\Tasks\Dto\TaskCreateDto;
use App\Tasks\Dto\TaskWithStatusDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Tasks\Service\TaskServiceInterface;
use App\Tasks\Repository\StatusRepositoryInterface;
use App\Tasks\Repository\TaskRepositoryInterface;

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

        $this->em->persist($task);
        $this->em->flush();

        return TaskDto::fromEntity($task);
    }


    public function updateTaskStatus(int $taskId, int $statusId): TaskWithStatusDto
    {
        $task = $this->taskRepository->findOneByIdWithStatus($taskId);
        $status = $this->statusRepository->findOneById($statusId);

        $task->setStatus($status);

        $this->em->persist($task);
        $this->em->flush();

        return TaskWithStatusDto::fromEntity($task);
    }
}