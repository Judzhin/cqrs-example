<?php

namespace App\BlogEngine\Command;

/**
 * Class CommentCommand
 * @package App\BlogEngine\Command
 */
class CommentCommand
{
    /**
     * CommentCommand constructor.
     * @param string $postId
     * @param string $comment
     */
    public function __construct(
        private string $postId,
        private string $comment
    )
    {}

    /**
     * @return string
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}