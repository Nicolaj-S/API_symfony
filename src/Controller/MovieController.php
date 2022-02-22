<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    #[Route('/movies', name: 'show_movies', methods: ['GET','HEAD'])]
    public function movieAll(ManagerRegistry $doctrine): Response{
        $movies = $doctrine -> getRepository(Movie::class) ->findAll();
        if (!$movies){
            throw $this ->createNotFoundException(
                'Ups.. seems that there is no movies available'
            );
        }
        return  $this ->render('pages/Movie/index.html.twig', ['movies' => $movies]);
    }

    #[Route('/movie/{id}', name: 'show_movie_by_id', methods: ['GET','HEAD'])]
    public function moviebyid(ManagerRegistry $doctrine, int $id): Response{
        $movie = $doctrine->getRepository(Movie::class)->find($id);
        foreach ($movie as $movies){
            $actors = $movie ->getActors();
            $genres = $movie -> getGenres();
            foreach ($actors as $actor){
                $id = $actor->getId();
            }
            foreach ($genres as $genre){
                $id = $genre ->getId();
            }
        }
        if (!$movie){
            throw $this->createNotFoundException(
                'No movie available for this id '.$id
            );
        }


        return $this->render('pages/Movie/show.html.twig', ['movie' =>$movie]);
    }

}
