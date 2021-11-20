<?php

namespace App\BlogEngine\Command;

use App\BlogEngine\DomainModel\Post;
use App\BlogEngine\DomainModel\PostId;
use App\BlogEngine\Infrastructure\Persistence\EventStore\PostRepository;

/**
 * Class CreatePostHandler
 * @package App\BlogEngine\Command
 * @todo rename PostEventStore
 */
class CreatePostHandler
{
    /**
     * CreatePostHandler constructor.
     * @param PostRepository $repository
     */
    public function __construct(
        private PostRepository $repository
    )
    {
    }

    /**
     * @param CreatePostCommand $aCreatePostCommand
     */
    public function handle(CreatePostCommand $aCreatePostCommand)
    {
        $aNewPost = Post::create(
            PostId::generate(),
            $aCreatePostCommand->getTitle(),
            $aCreatePostCommand->getContent()
        );

        $this->repository->add($aNewPost);
    }
}