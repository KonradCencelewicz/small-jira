<?php

namespace App\Tasks\Dto;

use App\Tasks\Entity\Task;

class TaskWithStatusDto
{
    public int $id;
    public string $title;
    public string $description;
    public ?\DateTimeInterface $deadline = null;
    public StatusDto $status;

    public function __construct(
        int $id, 
        string $title, 
        string $description, 
        StatusDto $status,
        ?\DateTimeInterface $deadline = null,
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
        $this->status = $status;
    }

    public static function fromEntity(Task $task): self
    {
        return new self(
            $task->getId(),
            $task->getTitle(),
            $task->getDescription(),
            StatusDto::fromEntity($task->getStatus()),
            $task->getDeadline(),
        );
    }
}