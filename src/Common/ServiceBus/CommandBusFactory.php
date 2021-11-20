<?php

namespace App\Common\ServiceBus;

use App\BlogEngine\Command\CommentHandler;
use App\BlogEngine\Command\CreatePostHandler;
use App\BlogEngine\Command\PublishPostHandler;
use App\BlogEngine\Command\UpdatePostHandler;
use App\BlogEngine\Infrastructure\Persistence\EventStore\PostRepository;

// use App\Repository\PostRepository;

/**
 * Class CommandBusFactory
 *
 * @package App\Common\ServiceBus
 */
class CommandBusFactory
{
    /**
     * @param PostRepository $repository
     * @return CommandBus
     */
    public function __invoke(PostRepository $repository): CommandBus
    {
        return (new CommandBus)
            ->register(new CreatePostHandler($repository))
            ->register(new PublishPostHandler($repository))
            ->register(new UpdatePostHandler($repository))
            ->register(new CommentHandler($repository));
    }
}