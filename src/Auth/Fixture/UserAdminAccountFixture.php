<?php

namespace App\Auth\Fixture;

use Doctrine\Persistence\ObjectManager;
use App\Auth\Service\UserManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserAdminAccountFixture extends Fixture
{
    private UserManagerInterface $userService;

    public function __construct(UserManagerInterface $userService)
    {
        $this->userService = $userService;
    }

    public function load(ObjectManager $om): void
    {
        $this->userService->createUser('admin@example.com', 'qwerty123', ['ROLE_ADMIN']);
    }
}
