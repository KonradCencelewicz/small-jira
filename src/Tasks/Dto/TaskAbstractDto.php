<?php

namespace App\Tasks\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use App\Tasks\Validator\Constraints as AppAssert;

class TaskAbstractDto
{
    #[Assert\NotBlank(message: 'Tytuł jest wymagany.')]
    #[Assert\Length(max: 255, maxMessage: 'Tytuł nie może mieć więcej niż 255 znaków.')]
    public string $title;

    #[Assert\Length(max: 4000, maxMessage: 'Opis nie może mieć więcej niż 4000 znaków.')]
    public ?string $description = null;

    public ?\DateTimeInterface $deadline = null;

    #[Assert\NotBlank(message: 'Status jest wymagany.')]
    public string $statusId;

    #[AppAssert\IsRootTask]
    public ?int $parentTaskId;

    public function __construct(
        string $title,
        ?string $description,
        ?\DateTimeInterface $deadline,
        int $statusId,
        ?int $parentTaskId
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
        $this->statusId = $statusId;
        $this->parentTaskId = $parentTaskId;
    }
}