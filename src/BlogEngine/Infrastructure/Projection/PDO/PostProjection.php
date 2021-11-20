<?php


namespace App\BlogEngine\Infrastructure\Projection\PDO;

use App\BlogEngine\DomainModel\PostWasCreated;
use App\BlogEngine\Infrastructure\Projection\BaseProjection;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class PostProjection
 * @package App\BlogEngine\Infrastructure\Projection\PDO
 */
class PostProjection extends BaseProjection
{
    /**
     * PostProjection constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param PostWasCreated $event
     */
    public function projectPostWasCreated(PostWasCreated $event)
    {
        $entity = (new Post)
            ->setId(Uuid::fromString($event->getAggregateId()))
            ->setTitle($event->getTitle())
            ->setContent($event->getContent());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}