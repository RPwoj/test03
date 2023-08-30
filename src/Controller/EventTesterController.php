<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventTesterController extends AbstractController
{
    #[Route('/event/tester', name: 'app_event_tester')]
    public function index(): Response
    {
        return $this->render('event_tester/index.html.twig', [
            'controller_name' => 'EventTesterController',
        ]);
    }
}
