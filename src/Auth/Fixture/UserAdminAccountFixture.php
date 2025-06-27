<?php

namespace App\Auth\Fixture;

use App\Auth\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAdminAccountFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    // Wstrzykuj hasher (Symfony >= 5.3)
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'qwerty123')
        );

        $manager->persist($user);
        $manager->flush();
    }
}
