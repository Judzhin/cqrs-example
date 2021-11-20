<?php


namespace App\BlogEngine\Query;

use App\Entity\Post;
use App\Repository\PostRepository;

/**
 * Class AllPostQueryHandler
 * @package App\BlogEngine\Query
 */
class AllPostsQueryHandler
{
    /**
     * AllPostQueryHandler constructor.
     *
     * @param PostRepository $repository
     */
    public function __construct(private PostRepository $repository)
    {}

    /**
     * @param AllPostsQuery $allPostsQuery
     * @return Post[]
     */
    public function handle(AllPostsQuery $allPostsQuery)
    {
        return $this->repository->findAll();
    }
}