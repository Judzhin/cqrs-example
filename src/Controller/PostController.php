<?php

namespace App\Controller;

use App\BlogEngine\Command\CreatePostCommand;
use App\BlogEngine\Query\PostQuery;
use App\Common\ServiceBus\CommandBus;
use App\Common\ServiceBus\HandlerNotFoundException;
use App\Common\ServiceBus\QueryBus;
use App\Form\CommentType;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 *
 * @package App\Controller
 */
class PostController extends AbstractController
{

    /**
     * @param $data
     * @return FormInterface
     */
    private function createPostForm($data)
    {
        return $this->createForm(PostType::class, $data);
    }

    #[Route('/post/new', name: 'new_post')]
    public function newPost(): Response
    {
        $aPostCommand = new CreatePostCommand('Write a blog post', 'The Post title');
        $form = $this->createPostForm($aPostCommand);

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param CommandBus $commandBus
     * @return Response
     * @throws HandlerNotFoundException
     */
    #[Route('/post/create', name: 'create_post', methods: ['POST'])]
    public function createPost(Request $request, CommandBus $commandBus): Response
    {
        $data = [
            'title' => 'The Post title',
            'content' => 'Write a blog post'
        ];

        $form = $this->createPostForm($data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $aPostCommand = new CreatePostCommand(
                $data['content'], $data['title']
            );

            $commandBus->handle($aPostCommand);
            $this->addFlash('notices', 'Post was created!');
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param string $id
     * @param QueryBus $queryBus
     * @return Response
     * @throws HandlerNotFoundException
     */
    #[Route('/post/show/{id}', name: 'post', methods: ['GET'])]
    public function showPost(string $id, QueryBus $queryBus): Response
    {
        $postQuery = new PostQuery($id);
        $post = $queryBus->handle($postQuery);

        $form = $this->createForm(CommentType::class, ['comment' => 'Write a comment']);

        return $this->render('post/show.html.twig', [
            'post' => $post, 'form' => $form->createView()
        ]);
    }
}
