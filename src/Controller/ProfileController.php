<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function show(EntityManagerInterface $entityManager, int $id, UserRepository $UserRepository): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $userName = $user ->getUsername();
        $userId = $user ->getId();



        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user_name' => $userName,
            'user_id' => $userId,
        ]);
    }
}
