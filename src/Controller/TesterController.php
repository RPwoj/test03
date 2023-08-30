<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class TesterController
{
    public $a = 'asd';

    #[Route('/aaa/{id}/{name}', name: 'test')]
    public function show($id = 0, $name = null, Request $request): Response    
    {


if ($name == null || !is_numeric($id)) {
    return new Response(
    'żle wypełniony url <br /> podaj prawidłowe id (numer) lub imię'
    );

    } else {

        $test = $request->query->get('ooo');
    return new Response(

        'Twoje id to ' . $id . ', a imię to ' . $name . '     ' . $test
    );

    }
            
    }
}
