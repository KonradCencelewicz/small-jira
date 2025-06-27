<?php

namespace App\Auth\Dto;

use App\Auth\Entity\User;

class UserDto
{
    public ?int $id = null;
    public string $email;
    public array $roles = [];
    // Add other fields you want to expose or transfer

    public function __construct(string $email, array $roles = [], ?int $id = null)
    {
        $this->email = $email;
        $this->roles = $roles;
        $this->id = $id;
    }

    public static function fromEntity(User $user): self
    {
        return new self(
            $user->getEmail(),
            $user->getRoles(),
            $user->getId()
        );
    }
}