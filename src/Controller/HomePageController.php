<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\AddNewPostType;
use App\Entity\User;
use App\Entity\Post;
use App\Entity\FriendCreator;
use App\Service\FriendsListGenerator;


class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    
    public function new(FriendsListGenerator $listGenerator, Request $request, EntityManagerInterface $entityManager, UserInterface $user = null): Response
    {
        $form = null;
        // $user = $this->getUser();
        $friendsToDisplay = [];
        $lastRegisteredUsers = [];
        $postFriendsIds = [];
        
        if($user) {
            $userId = $user -> getId();
            echo '<br />' . $userId . '<br />';
            $friends = $user->getFriends();

            
            foreach($friends as  $key => $value) {
                array_push($friendsToDisplay, new FriendCreator($key, $value['name'], $value['status']));
            }

            foreach($friendsToDisplay as $friendzik) {
                print_r($friendzik);
                echo '<br>Id Twojego kolegi to: ' . $friendzik -> id . '<br>'  ;
                array_push($postFriendsIds, $friendzik -> id);

            }



//////////////// posty //////

//// tutaj trzeba wykorzystac array z id Twoich znajomych, ktorzy maja status ze sa znajomymi
            $postFriendsIdsa = [1,2,3,4,5];
            $friendsPosts = $entityManager->getRepository(Post::class)->findBy(
                ['owner' => $postFriendsIdsa], // Use 'owner' as the property name that represents the owner
            );
            
            $counter = 1;
                    
            foreach($friendsPosts as $pop) {
            $postOwner = $entityManager->getRepository(User::class)->findBy(['id' => $pop -> getOwner()]);

            echo '<br><br>' . $counter . ' : ';
            echo 'id == ' . $pop -> getId() . '<br>';
            echo 'owner == ' . $postOwner[0] -> getId() . '<br>';
            echo 'title == ' . $pop -> getTitle() . '<br>';
            echo 'description == ' . $pop -> getDescription() . '<br>';
            echo 'publish date == ' . $pop -> getDate() -> format('Y-m-d H:i:s') . '<br>';
            $counter++;
            echo '<br><br>';
        }

        ///////// jakos trzeba na koniec zamienic to w obiekt, mozna do tego wykoprzystac puste entity tak jakw prztyapdku friend generatora

//////////////////////







            echo 'aaaaaa <br />';
            $friendsToDisplay = $listGenerator -> generate($user);
            echo 'aaaaaa <br />';

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

        } else {
            $lastRegisteredUsers = $entityManager->getRepository(User::class)->findBy(
                [],
                ['id' => 'DESC'],
                4
            );
        }
        

        $userPosts = '';
        if($user) {
            $userPosts = $user->getPosts();
        }

        return $this->render('home_page/index.html.twig', [
            
            'form' => $form,
            'lastRegisteredUsers' => $lastRegisteredUsers,
            'posty' => $userPosts,
            'friends' => $friendsToDisplay,
            'postsFriendsIds' => $postFriendsIds,
        ]);
        // } else {
        //     return $this->redirectToRoute('app_login');
        // }

    }



    
}
