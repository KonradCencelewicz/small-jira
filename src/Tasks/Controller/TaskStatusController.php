<?php

namespace App\Tasks\Controller;

use App\Tasks\Service\TaskServiceInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TaskStatusController extends AbstractController
{
    private TaskServiceInterface $taskService;

    public function __construct(
        TaskServiceInterface $taskService
    )
    {
        $this->taskService = $taskService;
    }

    #[Route('/task/{taskId}/status/{statusId}', name: 'app_task_status', methods: ['POST'])]
    public function update(
        int $taskId,
        int $statusId
    ): JsonResponse
    {
        $taskData = $this->taskService->updateTaskStatus($taskId, $statusId);

        return new JsonResponse([
            'success' => true,
            'task' => $taskData
        ]);
    }
}
