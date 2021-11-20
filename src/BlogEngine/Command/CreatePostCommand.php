<?php

namespace App\BlogEngine\Command;

/**
 * Class CreatePostCommand
 *
 * @package App\BlogEngine\Command
 */
class CreatePostCommand
{
    /**
     * CreatePostCommand constructor.
     * @param string $title
     * @param string $content
     */
    public function __construct(
        private string $title,
        private string $content
    )
    {
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}