<?php 

namespace App\Tasks\Service;

use App\Tasks\Dto\StatusDto;
use App\Tasks\Entity\Status;
use Doctrine\ORM\EntityManagerInterface;
use App\Tasks\Service\StatusManagerServiceInterface;

class StatusServiceManager implements StatusManagerServiceInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createStatus(string $value, int $sequence): StatusDto
    {
        $status = new Status();
        $status->setLabel($value);
        $status->setSequence($sequence);

        $this->em->persist($status);
        $this->em->flush();

        return StatusDto::fromEntity($status);
    }
}