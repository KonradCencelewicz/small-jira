<?php

namespace App\Tasks\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class TaskCreateDto
{
    #[Assert\NotBlank(message: 'Tytuł jest wymagany.')]
    #[Assert\Length(max: 255, maxMessage: 'Tytuł nie może mieć więcej niż 255 znaków.')]
    public string $title;

    #[Assert\Length(max: 4000, maxMessage: 'Opis nie może mieć więcej niż 4000 znaków.')]
    public ?string $description = null;

    public ?\DateTimeInterface $deadline = null;

    #[Assert\NotBlank(message: 'Status jest wymagany.')]
    public string $statusId;

    public function fromRequest(Request $request): self
    {
        $this->title = $request->request->get('title');
        $this->description = $request->request->get('description');
        $this->deadline = $request->request->get('deadline') ? new \DateTime($request->request->get('deadline')) : null;
        $this->statusId = $request->request->get('status');

        return $this;
    }
}