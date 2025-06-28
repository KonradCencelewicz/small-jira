<?php

namespace App\Tasks\Dto;

use App\Tasks\Entity\Task;
use App\Tasks\Dto\StatusDto;

class TaskDto
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTimeInterface $deadline = null;
    public StatusDto $status;

    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, StatusDto $status, ?\DateTimeInterface $deadline = null)
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