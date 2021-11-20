<?php

namespace App\Common\DomainModel;

use Buttercup\Protects\DomainEvents;

/**
 * Interface Projection
 * @package App\Common\DomainModel
 */
interface Projection
{
    /**
     * @param DomainEvents $eventStream
     * @return mixed
     */
    public function project(DomainEvents $eventStream);
}