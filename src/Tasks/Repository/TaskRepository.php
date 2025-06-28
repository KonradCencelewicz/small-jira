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
    public function all(): array
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Task[]
     */
    public function allWithParent(): array
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->leftJoin('t.parentTask', 'parentTask')
            ->addSelect('parentTask')
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneById(int $id): ?Task
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

    public function findTaskWithParent(int $taskId): ?Task
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->leftJoin('t.parentTask', 'parentTask')
            ->addSelect('parentTask')
            ->where('t.id = :taskId')
            ->setParameter('taskId', $taskId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
