<?php


namespace App\BlogEngine\Infrastructure\Persistence\EventStore;

use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class PDOEventStore
 *
 * @package App\BlogEngine\Infrastructure\Persistence\EventStore
 */
class PDOEventStore implements EventStore
{
    /**
     * DoctrineEventStore constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    public function commit(DomainEvents $events)
    {

    }

    public function getAggregateHistoryFor(IdentifiesAggregate $id)
    {
        // TODO: Implement getAggregateHistoryFor() method.
    }
}