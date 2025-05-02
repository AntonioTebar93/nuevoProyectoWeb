<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ControladorAntonioController extends AbstractController
{
    #[Route('/controlador/antonio', name: 'app_controlador_antonio')]
    public function index(): Response
    {
        return $this->render('controlador_antonio/index.html.twig');
    }

    #[Route('/controlador/antonio/parametros/{id}', name: 'app_controlador_antonio_parametros')]
    public function parametros(int $id): Response
    {
        return $this->render('controlador_antonio/parametros.html.twig', ['id' => $id]);
    }


    #[Route('/controlador/antonio/array', name: 'app_controlador_antonio_array')]
    public function array(): Response
    {
        $numeros = [1,2,3,4,5,6,7,8,9,10];
        return $this->render('controlador_antonio/array.html.twig', ['numeros' => $numeros]);
    }
}

