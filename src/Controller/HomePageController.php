<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Post;
use App\Form\AddNewPostType;
use App\Entity\User;
use App\Entity\FriendCreator;


class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]



    public function new(Request $request, EntityManagerInterface $entityManager, UserInterface $user = null): Response
    {
        $form = null;
        // $user = $this->getUser();
        if($user) {
            $userId = $user -> getId();
            echo '<br />' . $userId . '<br />';

            $friends = $user->getFriends();

            $friendsToDisplay = [];
            foreach($friends as  $key => $value) {
                array_push($friendsToDisplay, new FriendCreator($key, $value['name'], $value['status']));
            }

            print_r($friendsToDisplay);

            $post = new Post();
            $form = $this->createForm(AddNewPostType::class, $post, [
                'owner' => 2,
            ]);
            // $user = $this->getUser();
            // $form->get('owner')->setData($userId);
            
            
            
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $post -> setUserid($user);
                // $post = $form->getData();
                $entityManager->persist($post);
                $entityManager->flush();
            }

        } 

        $users = $entityManager->getRepository(User::class)->findBy(
            [],
            ['id' => 'DESC'],
            4
        );

        $userPosts = '';
        if($user) {
            $userPosts = $user->getPosts();
        }

        return $this->render('home_page/index.html.twig', [
            
            'form' => $form,
            'users' => $users,
            'posty' => $userPosts,
            'friends' => $friendsToDisplay,
        ]);
        // } else {
        //     return $this->redirectToRoute('app_login');
        // }

    }

    
}