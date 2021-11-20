<?php

namespace App\BlogEngine\DomainModel;

use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\IdentifiesAggregate;

/**
 * Class PostWasCreated
 * @package App\BlogEngine\DomainModel
 */
class PostWasCreated implements DomainEvent
{
    /**
     * PostWasCreated constructor.
     *
     * @param string $postId
     * @param string $title
     * @param string $content
     * @param int $state
     */
    public function __construct(
        private string $postId,
        private string $title,
        private string $content,
        private int $state
    )
    {
    }

    /**
     * @return IdentifiesAggregate|string
     */
    public function getAggregateId()
    {
        return $this->postId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }
}