<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;



class RespController extends AbstractController
{
    public function getData(Request $request, EntityManagerInterface $entityManager, UserInterface $user = null): Response
    {
        
        date_default_timezone_set('Europe/Warsaw');

        $currentDate = date("Y.m.d");

        $currentUserID = $user -> getId();

        $targetUserID = $request->get('targetUserID');
        
        // $newFriends = $friends;
        
        // array_push($newFriends, array('name' => 'Rafal', 'age' => 30));
        // $user->setFriends($newFriends);
        
        $targetUser = $entityManager->getRepository(User::class)->find($targetUserID);
  
        $usersFriends = $user->getFriends();
        $targetFriends = $targetUser->getFriends();

        $userName = $user->getUsername();
        $targetName = $targetUser->getUsername();
    
        $usersFriends[$targetUserID] = array('status' => '1', 'name' => $targetName, 'date' => $currentDate);
        $targetFriends[$currentUserID] = array('status' => '2', 'name' => $userName, 'date' => $currentDate);
       
        $user->setFriends($usersFriends);
        $targetUser->setFriends($targetFriends);

        
        $entityManager->persist($user);
        $entityManager->persist($targetUser);
        $entityManager->flush();

$testArr = [];
$testArr += $usersFriends;
$testArr += $targetFriends;
$arr = json_encode($testArr);
       

    $response = new Response($arr);
        // Return data as JSON response
        return $response;

    }
   
}
