<?php

namespace App\Tasks\Fixture;

use App\Tasks\Enum\StatusEnum;
use App\Tasks\Service\StatusManagerServiceInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixture extends Fixture
{
    private StatusManagerServiceInterface $service;

    public function __construct(StatusManagerServiceInterface $service)
    {
        $this->service = $service;
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->service->createStatus(StatusEnum::PENDING->value, 1, 'secondary');
        $this->service->createStatus(StatusEnum::DONE->value, 2, 'success');
        $this->service->createStatus(StatusEnum::REJECTED->value, 3, 'danger');
    }
}
