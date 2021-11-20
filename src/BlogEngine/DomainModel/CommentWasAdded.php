<?php

namespace App\BlogEngine\DomainModel;

use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\IdentifiesAggregate;

/**
 * Class CommentWasAdded
 * @package App\BlogEngine\DomainModel
 */
class CommentWasAdded implements DomainEvent
{
    /**
     * CommentWasAdded constructor.
     * @param PostId $postId
     * @param CommentId $commentId
     * @param string $comment
     */
    public function __construct(
        private PostId $postId,
        private CommentId $commentId,
        private string $comment
    )
    {}

    /**
     * The Aggregate this event belongs to.
     *
     * @return IdentifiesAggregate
     */
    public function getAggregateId()
    {
        return $this->postId;
    }

    /**
     * @return CommentId
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @return Comment
     */
    public function getComment()
    {
        return $this->comment;
    }
}
