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
       return $this->render('home/index.html.twig');
    }

    #[Route('/home/saludo', name: 'home_saludo')]
    public function saludo(): Response
    {
       die("hola soy tu saludo");
    }

    #[Route('/home/despedida', name: 'home_despedida')]
    public function despedida(): Response
    {
       die("hola soy tu despedida");
    }
    
}

