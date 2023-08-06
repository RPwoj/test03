<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?Post $cat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCat(): ?Post
    {
        return $this->cat;
    }

    public function setCat(?Post $cat): static
    {
        $this->cat = $cat;

        return $this;
    }
}
