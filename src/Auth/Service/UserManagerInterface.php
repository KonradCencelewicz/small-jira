<?php

namespace App\Auth\Service;

use App\Auth\Entity\User;
use App\Auth\Dto\UserDto;

interface UserManagerInterface
{
    public function createUser(string $email, string $plainPassword, array $roles = ['ROLE_USER']): UserDto;


    public function updatePassword(User $user, string $plainPassword): void;
}
