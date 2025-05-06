<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\PersonaEntity;
use App\Form\PersonaEntityForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

final class FormulariosController extends AbstractController
{
    #[Route('/formularios', name: 'formularios_inicio')]
    public function index(): Response
    {
        return $this->render('formularios/index.html.twig');
    }

    #[Route('/formularios/simple', name: 'formularios_simple')]
public function simple(Request $request): Response
{
    $form = $this->createFormBuilder(null)
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => ['placeholder' => 'Introduce tu nombre']
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'attr' => ['placeholder' => 'Introduce tus apellidos']
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Introduce tu email']
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Telefono',
                'attr' => ['placeholder' => 'Introduce tu telefono']
            ])
            ->add('save', SubmitType::class)
            ->getForm();
            
    $submittedToken = $request->request->get('token');
    $form->handleRequest($request);
    
    if ($form->isSubmitted()) {
        if ($this->isCsrfTokenValid('generico', $submittedToken)) {
            $campos = $form->getData();
            print_r($campos['nombre']);
            print_r($submittedToken);
            die();
        } else {
            $this->addFlash('css', 'warning');
            $this->addFlash('mensaje', 'Error en el token');
            return $this->redirectToRoute('formularios_simple');
        }
    }

    return $this->render('formularios/simple.html.twig', ['form' => $form]);
}


    #[Route('/formularios/simple2', name: 'formularios_simple2')]
    public function simple2(Request $request): Response
    {
        $form = $this->createFormBuilder(null)
                ->add('nombre', TextType::class,[
                    'label' => 'nombre',
                    'attr' => ['placeholder' => "Introduce tu nombre"]
                ])
                ->add('Enviar', SubmitType::class,[
                    'label' => 'Enviar',
                    'attr' => ['placeholder' => "Enviar"]
                ])
                ->getForm();
        
        $submittedToken = $request->request->get('token');
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($this->isCsrfTokenValid('generico', $submittedToken)){
                $campos = $form->getData();
               
                print_r($campos['nombre']."\n");
                print_r($submittedToken);
                die();
            }else{
                die('Error');
            }
        }
    

        return $this->render('formularios/simple2.html.twig', ['form' =>$form]);
    }

    #[Route('/formularios/entity', name: 'formularios_entity')]
    public function entity(Request $request): Response
    {
        $persona = new Persona();
        $form = $this->createFormBuilder($persona)
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => ['placeholder' => 'Introduce tu nombre']
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'attr' => ['placeholder' => 'Introduce tus apellidos']
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Introduce tu email']
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Telefono',
                'attr' => ['placeholder' => 'Introduce tu telefono']
            ])
            ->add('save', SubmitType::class)
            ->getForm();
            $submittedToken = $request->request->get('token');
            $form->handleRequest($request);
            
            if ($form->isSubmitted()) {
                if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                    $campos = $form->getData();
                    
                    $persona->setNombre($campos->getNombre());
                    $persona->setApellidos($campos->getApellidos());    
                    $persona->setEmail($campos->getEmail());
                    $persona->setTelefono($campos->getTelefono());

                    die($persona->getNombre()."\n".$persona->getApellidos()."\n".$persona->getEmail()."\n".$persona->getTelefono());    
                } else {
                    $this->addFlash('css', 'warning');
                    $this->addFlash('mensaje', 'Error en el token');
                    return $this->redirectToRoute('formularios_entity');
                }
            }
        
            return $this->render('formularios/entity.html.twig', ['form' => $form]);
        }

    #[Route('/formularios/type-form', name: 'formularios_type_form')]
    public function type_form(Request $request): Response
    {
        $persona = new PersonaEntity();
        $form= $this->createForm(PersonaEntityForm::class, $persona);
        $submittedToken = $request->request->get('token');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                $campos = $form->getData();
                
                $persona->setNombre($campos->getNombre());
                $persona->setApellidos($campos->getApellidos());    
                $persona->setEmail($campos->getEmail());
                $persona->setTelefono($campos->getTelefono());
                $persona->setPais($campos->getPais());

                die($persona->getNombre()."\n".$persona->getApellidos()."\n".$persona->getEmail()."\n".$persona->getTelefono() ."\n".$persona->getPais());    
            } else {
                $this->addFlash('css', 'warning');
                $this->addFlash('mensaje', 'Error en el token');
                return $this->redirectToRoute('formularios_entity');
            }
        }

        return $this->render('formularios/typeForm.html.twig', ['form' => $form]);
    }



}

