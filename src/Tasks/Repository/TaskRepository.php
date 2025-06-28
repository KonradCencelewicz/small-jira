<?php

namespace App\Tasks\Repository;

use App\Tasks\Entity\Task;
use App\Tasks\Dto\TaskWithStatusDto;
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
     * @return TaskWithStatusDto[]
     */
    public function allWithStatus(): array
    {
        $tasks = $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getResult();

        return array_map(fn(Task $task) => TaskWithStatusDto::fromEntity($task), $tasks);
    }

    public function findOneByIdWithStatus(int $id): ?TaskWithStatusDto
    {
        $task = $this->createQueryBuilder('t')
            ->leftJoin('t.status', 's')
            ->addSelect('s')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->orderBy('t.deadline', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
        
            return $task ? TaskWithStatusDto::fromEntity($task) : null;    
        }
}
