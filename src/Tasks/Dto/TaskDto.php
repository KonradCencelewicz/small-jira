<?php

namespace App\Tasks\Dto;

use App\Tasks\Entity\Task;

class TaskDto
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTimeInterface $deadline = null;

    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, ?\DateTimeInterface $deadline = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
    }

    public static function fromEntity(Task $task): self
    {
        return new self(
            $task->getId(),
            $task->getTitle(),
            $task->getDescription(),
            $task->getDeadline(),
        );
    }
}