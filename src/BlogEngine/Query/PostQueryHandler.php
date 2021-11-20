<?php


namespace App\BlogEngine\Query;

use App\Entity\Post;
use App\Repository\PostRepository;

/**
 * Class PostQueryHandler
 * @package App\BlogEngine\Query
 */
class PostQueryHandler
{
    /**
     * PostQueryHandler constructor.
     *
     * @param PostRepository $repository
     */
    public function __construct(private PostRepository $repository)
    {
    }

    /**
     * @param PostQuery $aPostQuery
     * @return Post|null
     */
    public function handle(PostQuery $aPostQuery)
    {
        // return $this->repository->get($aPostQuery->getId());
        return $this->repository->find($aPostQuery->getId());
    }
}