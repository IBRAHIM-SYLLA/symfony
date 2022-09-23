<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
us%e Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticlesRepository $articlesRepository, Request $request): Response
    {
        $articles= $articlesRepository->findBy([], ['date' => 'DESC']);
        return $this->render('blog/index.html.twig', [ 'articles' => $articles,]);
    }

    #[Route('/blog/detail/{id}', name: 'detail')]
    public function SingleArticle(Articles $article): Response
    {
        return $this->render('blog/detail.html.twig', compact('article'));
    }
}
