<?php

namespace App\Controller;
use App\Entity\Articles;
use App\Form\CreateArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(): Response
    {
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }

    #[Route('/articles', name: 'app_articles')]
    public function CreateArticle(Request $request,EntityManagerInterface $entityManager): Response
    {
        $article = new Articles();
        $form = $this->createForm(CreateArticleType::class, $article);
        $article -> setDate(new \DateTime());
        $idUser= $this->getUser('id');
        $article->setUser($idUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('app_main');
        }
        return $this->render('articles/index.html.twig', [
            'CreateArticle' => $form->createView()
        ]);
    }

    // public function register(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $article = new Articles();
    //     $form = $this->createForm(RegistrationFormType::class, $article);
    // }
}
