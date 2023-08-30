<?php

namespace App\Controller;
use App\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class AnimalsListController extends AbstractController
{
    #[Route('/animals/list', name: 'app_animals_list')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {

        $animals = $doctrine
        ->getRepository(Animal::Class)
        -> findAll();

        return $this->render('animals_list/index.html.twig', [
            'controller_name' => 'AnimalsListController',
            'animals' => $animals,
        ]);
    }
}
