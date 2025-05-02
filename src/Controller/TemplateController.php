<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NuevoControladorController extends AbstractController
{
    #[Route('/nuevo/controlador', name: 'app_nuevo_controlador')]
    public function index(): Response
    {
        return $this->render('nuevo_controlador/index.html.twig', [
            'controller_name' => 'NuevoControladorController',
        ]);
    }
}
