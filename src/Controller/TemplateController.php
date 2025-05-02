<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class TemplateController extends AbstractController
{
    #[Route('/template', name: 'template_inicio')]
    public function index(): Response
    {
        die("Controlador de template");
    }

    #[Route('/template/parametros/{id}/{slug}', name: 'template_parametros', defaults:
    ['id' =>0, 'slug' => 'por defecto'])]
    public function parametros(int $id, string $slug): Response
    {
        
        if($id < 0){
            throw $this->createNotFoundException("Esta URL no está disponible");
        }
        die("id={$id} | slug={$slug}");

        
    }

    #[Route('/template/excepcion', name: 'template_excepcion')]
    public function excepcion(): Response
    {
        //throw $this->createNotFoundException("Esta URL no está disponible");
        throw new NotFoundHttpException("Esta URL no está disponible con el otro");
    }
}

