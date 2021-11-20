<?php

namespace App\BlogEngine\Command;


use App\Repository\PostRepository;

class CommentHandler
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param CommentCommand $aCommentCommand
     */
    public function handle(CommentCommand $aCommentCommand)
    {
        //$aNewPost = $this->postRepository->get(
        //    PostId::fromString($aCommentCommand->getPostId())
        //);

        // $aNewPost->comment($aCommentCommand->getComment());

        // $this->postRepository->add($aNewPost);
    }
}