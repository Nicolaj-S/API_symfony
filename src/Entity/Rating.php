<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Rating;

    #[ORM\OneToMany(mappedBy: 'rating', targetEntity: movie::class)]
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->Rating;
    }

    public function setRating(int $Rating): self
    {
        $this->Rating = $Rating;

        return $this;
    }

    /**
     * @return Collection<int, movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->setRating($this);
        }

        return $this;
    }

    public function removeMovie(movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getRating() === $this) {
                $movie->setRating(null);
            }
        }

        return $this;
    }
}
