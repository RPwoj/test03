<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class MyPageLoadListener
{
    public function onPageLoad(RequestEvent $event)
    {
        // Tutaj umieść kod funkcji, którą chcesz wykonać przy każdym ładowaniu strony
        echo 'funkcja';
    }
}