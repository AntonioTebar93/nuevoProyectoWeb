<?php

namespace App\Form;

use App\Entity\PersonaEntityUpload;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaEntityUploadForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, ['label' => 'nombre','attr' => ['placeholder' => 'Introduce tu nombre']])
            ->add('correo', TextType::class, ['label' => 'correo', 'attr' => ['placeholder' => 'Introduce tu correo']])
            ->add('telefono', TextType::class, ['label' => 'telefono', 'attr' => ['placeholder' => 'Introduce tu telefono']])
            ->add('pais', ChoiceType::class, [
                'label' =>'pais',
                'placeholder' => 'Selecciona tu país',
                'choices' => [
                    'España' => 'España',
                    'Francia' => 'Francia',
                    'Alemania' => 'Alemania',
                    'Italia' => 'Italia',
                    'Portugal' => 'Portugal'
                ]
            ])
            ->add('foto', FileType::class, ['mapped' =>true]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonaEntityUpload::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ]);
    
    }
}
