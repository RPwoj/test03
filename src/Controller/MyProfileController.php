<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class MyProfileController extends AbstractController
{
    #[Route('/my-profile', name: 'app_my_profile')]
    public function index(UserInterface $user): Response
    {
        return $this->render('my_profile/index.html.twig', [
            'controller_name' => 'MyProfileController',
            'user' => $user,
        ]);
    }
}
