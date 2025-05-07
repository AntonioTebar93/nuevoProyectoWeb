<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\PersonaEntity;
use App\Entity\PersonaValidation;
use App\Entity\PersonaEntityUpload;
use App\Form\PersonaEntityForm;
use App\Form\PersonaValidationForm;
use App\Form\PersonaEntityUploadForm;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


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

    #[Route('/formularios/validation', name: 'formularios_validation')]
    public function validation(Request $request, ValidatorInterface $validator): Response
    {
        $validacion = new PersonaValidation();
        $form = $this->createForm(PersonaValidationForm::class, $validacion);
        $submittedToken = $request->request->get('token');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                $errors = $validator->validate($validacion);
                if (count($errors) > 0) {
                    return $this->render('formularios/validation.html.twig', [
                        'form' => $form,
                        'errors' => $errors
                    ]);
                } else {
                    $campos = $form->getData();
                    $validacion->setNombre($campos->getNombre());
                    $validacion->setCorreo($campos->getCorreo());
                    $validacion->setTelefono($campos->getTelefono());
                    $validacion->setPais($campos->getPais());

                    die($validacion->getNombre()."\n".$validacion->getCorreo()."\n".$validacion->getTelefono()."\n".$validacion->getPais());
                }
            } else {
                $this->addFlash('css', 'warning');
                $this->addFlash('mensaje', 'Error en el token');
                return $this->redirectToRoute('formularios_validation');
            }
        }

       
        return $this->render('formularios/validation.html.twig', [
            'form' => $form,
            'errors' => []
        ]);
    }

    #[Route('/formularios/upload', name: 'formularios_upload')]
    public function upload(Request $request, ValidatorInterface $validator): Response
    {
        $upload = new PersonaEntityUpload();
        $form = $this->createForm(PersonaEntityUploadForm::class, $upload);
        $submittedToken = $request->request->get('token');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                $errors = $validator->validate($upload);
                if (count($errors) > 0) {
                    return $this->render('formularios/upload.html.twig', [
                        'form' => $form,
                        'errors' => $errors
                    ]);
                } else {
                    $foto = $form->get('foto')->getData();
                    if($foto){
                      $originalName = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);  
                      $newFileName = time().'.'.$foto->guessExtension();
                      try {
                        $foto->move($this->getParameter('fotos_directory'),$newFileName);
                      } catch (FileException $e) {
                        throw new \Exception('Error al subir el archivo');
                      }
                    }
                    $campos = $form->getData();
                    $upload->setNombre($campos->getNombre());
                    $upload->setCorreo($campos->getCorreo());
                    $upload->setTelefono($campos->getTelefono());
                    $upload->setPais($campos->getPais());
                    $upload->setFoto($newFileName);

                  die($upload->getNombre()."\n".$upload->getCorreo()."\n".$upload->getTelefono()."\n".$upload->getPais()."\n".$upload->getFoto());
                }
            } else {
                $this->addFlash('css', 'warning');
                $this->addFlash('mensaje', 'Error en el token');
                return $this->redirectToRoute('formularios_upload');
            }
        }

        return $this->render('formularios/upload.html.twig', [
            'form' => $form,
            'errors' => []
        ]);
    }


}




