<?php

namespace App\Controller;

use App\BlogEngine\Query\AllPostsQuery;
use App\Common\ServiceBus\HandlerNotFoundException;
use App\Common\ServiceBus\QueryBus;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 *
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @param QueryBus $queryBus
     * @return Response
     * @throws HandlerNotFoundException
     */
    #[Route('/', name: 'homepage')]
    public function index(QueryBus $queryBus): Response
    {
        /** @var Post[] $posts */
        $posts = $queryBus->handle(new AllPostsQuery);

        return $this->render('homepage/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
