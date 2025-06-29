<?php

namespace App\Tasks\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Tasks\Validator\Constraints as AppAssert;

class TaskCreateDto extends TaskAbstractDto
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

    public function __construct(array $data) {
        parent::__construct(
            $data['title'],
            $data['description'],
            $data['deadline'],
            $data['statusId'],
            $data['parentTaskId'],
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self([
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'deadline' => $request->request->get('deadline') ? new \DateTime($request->request->get('deadline')) : null,
            'statusId' => (int) $request->request->get('status'),
            'parentTaskId' => (int) $request->request->get('parent_task_id')
        ]);
    }
}