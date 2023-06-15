<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Animal;
use App\Form\AddAnimalType;
use Symfony\Component\HttpFoundation\Request;
class AddAnimalController extends AbstractController
{
    #[Route('/add/animal', name: 'app_add_animal')]
   

    public function new(Request $request): Response
    {
        $animal = new Animal();
        // ...

        $form = $this->createForm(AddAnimalType::class, $animal);

        return $this->render('add_animal/index.html.twig', [
            'form' => $form,
        ]);
    }
    
}
