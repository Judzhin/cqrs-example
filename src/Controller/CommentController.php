<?php

namespace App\Controller;

use App\BlogEngine\Command\CommentCommand;
use App\BlogEngine\Query\PostQuery;
use App\Common\ServiceBus\CommandBus;
use App\Common\ServiceBus\HandlerNotFoundException;
use App\Common\ServiceBus\QueryBus;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends AbstractController
{
    /**
     * @param Request $request
     * @param string $id
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     * @return Response
     * @throws HandlerNotFoundException
     */
    #[Route('/post/{id}/comment', name: 'comment')]
    public function index(Request $request, string $id, CommandBus $commandBus, QueryBus $queryBus): Response
    {
        $form = $this->createForm(CommentType::class, ['comment' => 'Write a comment']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $aCommentCommand = new CommentCommand(
                $id, $data['comment']
            );

            $commandBus->handle($aCommentCommand);

            $this->addFlash('notices', 'Comment was added!');
            return $this->redirectToRoute('post', ['id' => $id]);
        }

        $postQuery = new PostQuery($id);
        $post = $queryBus->handle($postQuery);

        return $this->render('post.html.twig', ['post' => $post, 'form' => $form->createView()]);
    }
}
