<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FriendCreator;   


class FriendsController extends AbstractController
{
    #[Route('/my-profile/friends', name: 'app_friends')]
    public function index(UserInterface $currentUser, EntityManagerInterface $entityManager): Response
    {



        $friendsToDisplay = [];

        $currentUserFriends = $currentUser->getFriends();
            
        foreach($currentUserFriends as  $key => $value) {
            array_push($friendsToDisplay, new FriendCreator($key, $value['name'], $value['status']));
        }
        print_r($friendsToDisplay);
        // $targetUser = $entityManager->getRepository(Product::class)->find($id);


        return $this->render('/my_profile/friends/index.html.twig', [
            'controller_name' => 'FriendsController',
        ]);
    }
}
