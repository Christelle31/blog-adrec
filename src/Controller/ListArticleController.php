<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListArticleController extends AbstractController
{
    /**
     * @Route("/list/article/page-{offset}", name="list_article")
     */
    public function index(ArticleRepository $repo, $offset)
    {
        $articles = $repo->findBy([], ['title' => 'ASC'], 10, $offset); // Utilise le repository article pour
        // récupérer la liste des articles en base de données.


        return $this->render('list_article/index.html.twig', [
            'controller_name' => 'ListArticleController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/list/article/{id}/show", name="show_one_article")
     */
    public function show(ArticleRepository $repo, $id)
    {
        $article = $repo->find($id);

        if ($article === null) {
            throw $this->createNotFoundException('Article introuvable');
        }

        dump($article);

        return $this->render('list_article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/list/article/create", name="create_one_article")
     */
    public function create(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $article->setCreatedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'article.form.success.label');

            if ($form->get('submitAndRestart')->isClicked()) {
                return $this->redirectToRoute('create_one_article');
            }

            return $this->redirectToRoute('show_one_article', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('list_article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
