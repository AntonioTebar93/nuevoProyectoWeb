<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\CategoriaApiForm;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class UtilidadesController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }


    #[Route('/utilidades', name: 'utilidades_inicio')]
    public function index(): Response
    {
        return $this->render('utilidades/index.html.twig');
    }

    #[Route('/utilidades/mailer', name: 'utilidades_mailer')]
    public function mailer(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from(new Address('toni_11.tebar@hotmail.com', 'Antonio'))
            ->to('phoenixrojo7@gmail.com')
            ->subject('Correo de prueba')
            ->html('<p>Hola como estas? me llamo antonio</p>');

            try {
                $mailer->send($email);
                $this->addFlash('success', 'El correo se ha enviado correctamente');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al enviar el correo: ' . $e->getMessage());
            }
            
            
        return $this->render('utilidades/mail.html.twig');
    }

    #[Route('/utilidades/api-rest', name: 'utilidades_consumir_api')]
    public function api_rest(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://www.api.tamila.cl/api/categorias',
            [
                'headers' =>
                [
                  'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsImlhdCI6MTc0NjYzMTUzNywiZXhwIjoxNzQ5MjIzNTM3fQ.7RRxWxtWutBMEhWArrdnyYpFD6QZnpdSr9EcYuDY4s4'
                ]
            ]
            
            );
           /*$status = $response->getStatusCode();
           echo $status;
           exit();
           */
          
        return $this->render('utilidades/consumir_api.html.twig', ['response' => $response]);
    }


 #[Route('/utilidades/api-rest/crear', name: 'utilidades_metodo_post')]
public function api_post(Request $request): Response
{
    $form = $this->createForm(CategoriaApiForm::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $campos = $form->getData();

        
            // Obtener token Bearer automáticamente
            $loginResponse = $this->client->request(
                'POST',
                'https://www.api.tamila.cl/api/login',
                [
                    'json' => [
                        'correo' => 'info@tamila.cl',
                        'password' => 'p2gHNiENUw'
                    ]
                ]
            );

            $loginData = $loginResponse->toArray();
            if (!isset($loginData['token'])) {
                throw new \Exception('Token no recibido');
            }

            $token = $loginData['token'];

            $this->client->request(
                'POST',
                'https://www.api.tamila.cl/api/categorias',
                [
                    'json' => ['nombre' => $campos['categoria']],
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token
                    ]
                ]
            );

            $this->addFlash('success', 'La categoría se ha creado correctamente');
            return $this->redirectToRoute('utilidades_metodo_post', ['creado' => 1]);

       
    }

    return $this->render('utilidades/api_rest_add.html.twig', ['form' => $form]);
}

}
