<?php

namespace App\Tasks\Repository;

use App\Tasks\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use App\Tasks\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return Task[]
     */
    public function allWithStatus(): array
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneByIdWithStatus(int $id): ?Task
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
        }
}
