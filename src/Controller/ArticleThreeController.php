<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleThreeController extends AbstractController
{
    /**
     * @Route("/article/one", name="article_one")
     */
    public function index()
    {
        return $this->render('article_one/index.html.twig', [
            'controller_name' => 'ArticleOneController',
        ]);
    }
}
