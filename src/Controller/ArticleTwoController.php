<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleTwoController extends AbstractController
{
    /**
     * @Route("/article/two", name="article_two")
     */
    public function index()
    {
        return $this->render('article_two/index.html.twig', [
            'controller_name' => 'ArticleTwoController',
        ]);
    }
}
