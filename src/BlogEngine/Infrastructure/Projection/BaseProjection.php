<?php

namespace App\BlogEngine\Infrastructure\Projection;

use App\Common\DomainModel\Projection;
use Buttercup\Protects\DomainEvents;
use Verraes\ClassFunctions\ClassFunctions;

/**
 * Class BaseProjection
 * @package App\BlogEngine\Infrastructure\Projection
 */
abstract class BaseProjection implements Projection
{
    /**
     * @param DomainEvents $eventStream
     * @return mixed|void
     */
    public function project(DomainEvents $eventStream)
    {
        foreach ($eventStream as $event) {
            $projectMethod = 'project' . ClassFunctions::short($event);
            $this->$projectMethod($event);
        }
    }

}