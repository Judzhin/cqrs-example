<?php

namespace App\Common\ServiceBus;

use App\BlogEngine\Query\AllPostsQueryHandler;
use App\BlogEngine\Query\PostQueryHandler;
use App\Repository\PostRepository;

/**
 * Class QueryBus
 * @package App\Common\ServiceBus
 */
class QueryBusFactory
{
    /**
     * @param PostRepository $repository
     * @return QueryBus
     */
    public function createQueryBus(PostRepository $repository): QueryBus
    {
        $queryBus = new QueryBus;
        $queryBus->register(new PostQueryHandler($repository));
        $queryBus->register(new AllPostsQueryHandler($repository));
        return $queryBus;
    }
}