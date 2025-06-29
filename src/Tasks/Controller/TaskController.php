<?php

namespace App\Tasks\Controller;

use App\Tasks\Dto\TaskCreateDto;
use App\Tasks\Service\TaskServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Tasks\Repository\TaskRepositoryInterface;
use App\Tasks\Repository\StatusRepositoryInterface;
use App\Tasks\Service\TaskStatusGrouperServiceInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
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
                'tasks' => $taskGrouper->groupByStatus($taskRepository->allWithParent()),
                'statuses' => $statusRepository->all(),
            ]
        );
    }

    #[Route('/task/create', name: 'app_task_create', methods: ['GET'])]
    public function create(
        Request $request,
        TaskRepositoryInterface $taskRepository,
        StatusRepositoryInterface $statusRepository,
    ): Response
    {
        $parentTaskId = $request->query->get('parent_task_id');;
        $parentTask = $parentTaskId ? $taskRepository->findOneById($parentTaskId) : null;

        return $this->render(
            'Tasks/task_form/task_create/index.html.twig',
            [
                'parentTask' => $parentTask,
                'statuses' => $statusRepository->all()
            ]
        );
    }

    #[Route('/task/create', name: 'app_task_store', methods: ['POST'])]
    public function store(
        Request $request,
        ValidatorInterface $validator,
        TaskServiceInterface $taskService,
        TaskRepositoryInterface $taskRepository,
        StatusRepositoryInterface $statusRepository
    ): Response {
        $parentTaskId = $request->request->get('parent_task_id');
        $parentTask = $parentTaskId ? $taskRepository->findOneById($parentTaskId) : null;

        $dto = new TaskCreateDto();
        $errors = $validator->validate($dto->fromRequest($request));

        if (count($errors) > 0) {
            return $this->render(
                'Tasks/task_form/task_create/index.html.twig',
                [
                    'parent_task_id' => $parentTask,
                    'statuses' => $statusRepository->all(),
                    'errors' => $errors
                ]
            );
        }

        $taskService->createTask($dto, $parentTask);

        return $this->redirectToRoute('app_task_dashboard');
    }

    #[Route('/task/{id}/edit', name: 'app_task_edit', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function edit(
        int $id,
        TaskRepositoryInterface $taskRepository, 
        StatusRepositoryInterface $statusRepository,
    ): Response
    {
        return $this->render(
            'Tasks//task_form/task_edit/index.html.twig',
            [
                'task' => $taskRepository->findOneById($id),
                'statuses' => $statusRepository->all()
            ]
        );
    }

    #[Route('/task/{id}/edit', name: 'app_task_update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function update(
        Request $request,
        ValidatorInterface $validator,
        TaskServiceInterface $taskService,
        StatusRepositoryInterface $statusRepository
    ): Response {
        // $dto = new TaskCreateDto();
        // $errors = $validator->validate($dto->fromRequest($request));

        // if (count($errors) > 0) {
        //     return $this->render(
        //         'Tasks/task_form/task_create/index.html.twig',
        //         [
        //             'statuses' => $statusRepository->all(),
        //             'errors' => $errors
        //         ]
        //     );
        // }

        // $taskService->createTask($dto);

        return $this->redirectToRoute('app_task_dashboard');
    }
}
