<?php

namespace App\Service;
use App\Entity\FriendCreator;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;




class FriendsListGenerator
{
    public $generatedList = [];
    public function generate(UserInterface $user)
    {
        // echo 'test';
        // $user = $entityManager->getRepository(User::class)->find($id);
        $friends = $user->getFriends();


        foreach($friends as  $key => $value) {
            array_push($this -> generatedList, new FriendCreator($key, $value['name'], $value['status']));
        }

       
        return $this -> generatedList;
    }
}