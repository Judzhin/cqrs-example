<?php

namespace App\BlogEngine\Infrastructure\Persistence\EventStore;

use Buttercup\Protects\AggregateHistory;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IdentifiesAggregate;

/**
 * Interface EventStore
 * @package App\BlogEngine\Infrastructure\Persistence\EventStore
 */
interface EventStore
{
    /**
     * @param DomainEvents $events
     *
     * @return void
     */
    public function commit(DomainEvents $events);

    /**
     * @param IdentifiesAggregate $id
     *
     * @return AggregateHistory
     */
    public function getAggregateHistoryFor(IdentifiesAggregate $id);
}