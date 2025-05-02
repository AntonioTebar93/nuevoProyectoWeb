<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PruebaController extends AbstractController
{
    #[Route('/prueba', name: 'app_prueba')]
    public function index(): Response
    {
        $usuarios =[
            ['nombre' => 'Antonio',
            'apellidos' => 'Tebar Alfaro',
            'email' => 'ant@gmail.com',
          ],
          ['nombre' => 'Antonio2',
            'apellidos' => 'Tebar García',
            'email' => 'garcia@gmail.com',
          ]  
        ];
        return $this->render('prueba/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }
}
