<?php

namespace App\Tasks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Tasks\Repository\StatusRepositoryInterface;
use App\Tasks\Repository\TaskRepositoryInterface;
use App\Tasks\Service\TaskStatusGrouperService;
use App\Tasks\Service\TaskStatusGrouperServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TaskController extends AbstractController
{
    #[Route('/task/dashboard', name: 'app_task_dashboard')]
    public function index(
        TaskRepositoryInterface $taskRepository, 
        StatusRepositoryInterface $statusRepository,
        TaskStatusGrouperServiceInterface $taskGrouper
    ): Response
    {
        return $this->render(
            'Tasks/tasks_dashboard/index.html.twig',
            [
                'tasks' => $taskGrouper->groupByStatus($taskRepository->allWithStatus()),
                'statuses' => $statusRepository->all(),
            ]
        );
    }

    #[Route('/task/create', name: 'app_task_create')]
    public function create(): Response
    {
        return $this->render('Tasks/tasks_dashboard/index.html.twig');
    }
}
