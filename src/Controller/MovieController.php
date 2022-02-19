<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'movie')]
    public function index(): Response
    {
        $movies = ["Doctor Strange in the Multiverse of Madness","Top Gun: Maverick","Jurassic World: Dominion"];
        return $this -> render('pages/index.html.twig',array('movies' => $movies));
    }
}
