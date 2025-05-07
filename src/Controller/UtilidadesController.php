<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;



final class UtilidadesController extends AbstractController
{
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
}
