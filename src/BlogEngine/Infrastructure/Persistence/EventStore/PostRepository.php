<?php


namespace App\BlogEngine\Infrastructure\Persistence\EventStore;

use App\BlogEngine\Infrastructure\Projection\PDO\PostProjection;
use Buttercup\Protects\IdentifiesAggregate;
use Buttercup\Protects\IsEventSourced;
use Buttercup\Protects\RecordsEvents;

/**
 * Class PDOEventStore
 *
 * @package App\BlogEngine\Infrastructure\Persistence\EventStore
 */
class PostRepository implements \App\BlogEngine\DomainModel\PostRepository
{
    /**
     * PostRepository constructor.
     *
     * @param PDOEventStore $eventStore
     * @param PostProjection $postProjection
     */
    public function __construct(
        private PDOEventStore $eventStore,
        private PostProjection $postProjection
    )
    {}

    /**
     * @param IdentifiesAggregate $aggregateId
     * @return IsEventSourced|void
     */
    public function get(IdentifiesAggregate $aggregateId)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param RecordsEvents $aggregate
     */
    public function add(RecordsEvents $aggregate)
    {
        $events = $aggregate->getRecordedEvents();
        $this->eventStore->commit($events);
        $this->postProjection->project($events);

        $aggregate->clearRecordedEvents();
    }
}