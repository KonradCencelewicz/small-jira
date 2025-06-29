<?php

namespace App\Tasks\Dto;

use App\Tasks\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use App\Tasks\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class TaskDto extends TaskAbstractDto
{
    #[AppAssert\TaskExist()]
    #[Assert\NotNull(message: 'ID jest wymagane.')]
    public int $id;

    public function __construct(array $data)
    {
        $this->id = $data['id'];

        parent::__construct(
            $data['title'],
            $data['description'],
            $data['deadline'],
            $data['statusId'],
            $data['parentTaskId'],
        );
    }

    public static function fromEntity(Task $task): self
    {
        return new self([
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'deadline' => $task->getDeadline(),
            'statusId' => $task->getStatus()->getId(),
            'parentTaskId' => $task->getParentTask()?->getId(),
        ]);
    }

    public static function fromRequest(Request $request): self
    {
        return new self([
            'id' => $request->request->get('id'),
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'deadline' => $request->request->get('deadline') ? new \DateTime($request->request->get('deadline')) : null,
            'statusId' => (int) $request->request->get('status'),
            'parentTaskId' => (int) $request->request->get('parent_task_id')
        ]);
    }
}