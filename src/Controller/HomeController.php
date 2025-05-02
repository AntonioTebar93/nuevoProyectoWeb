<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home_inicio')]
    public function index(): Response
    {
       die("hola");
    }

    #[Route('/home/saludo', name: 'home_inicio2')]
    public function saludo(): Response
    {
       die("hola soy tu saludo");
    }
    
}

