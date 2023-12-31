<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;                   
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SecurityBundle\Security;


use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    #[Route('/animal', name: 'app_animal')]
    public function new(Request $request, EntityManagerInterface $entityManager, UserInterface $user)
    {

        if ($this->security->isGranted('IS_AUTHENTICATED_FULLY')) {

            $animal = new Animal();

            $form = $this->createForm(AnimalType::class, $animal);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $animal->setName($form->get('name')->getData());
    
                $entityManager->persist($animal);
                $entityManager->flush();
                // do anything else you need here, like send an email
    
                return $this->redirectToRoute('app_home_page');
            }
            
            return $this->render('animal/index.html.twig', [
                'form' => $form,
            ]);
        } else {
            echo 'xd';
        }
      
       
    }
}
