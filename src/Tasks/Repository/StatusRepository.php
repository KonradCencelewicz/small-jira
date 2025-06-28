<?php

namespace App\Tasks\Repository;

use App\Tasks\Dto\StatusDto;
use App\Tasks\Entity\Status;
use Doctrine\Persistence\ManagerRegistry;
use App\Tasks\Repository\StatusRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Status>
 */
class StatusRepository extends ServiceEntityRepository implements StatusRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }

    /**
     * @return StatusDto[]
     */
    public function all(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.sequence', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneById(int $id): ?Status
    {
        return $this->find($id);
    }
}
