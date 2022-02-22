<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController{

    #[Route('/Index', name: 'Index', methods: ['GET','HEAD'])]
    public function homepage(ManagerRegistry $doctrine):Response{
        $movies = $doctrine ->getRepository(Movie::class)->findAll();
        if (!$movies){
            throw $this->createNotFoundException(
                'Ups.. seems that there is no movies available'
            );
        }
        return $this->render('pages/Index.html.twig',['movies' => $movies]);
    }
}