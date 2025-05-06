<?php

namespace App\Form;

use App\Entity\PersonaEntity;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaEntityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
        ->add('pais', ChoiceType::class,
        [
            'choices' => [
                'España' => 'España',
                'Francia' => 'Francia',
                'Alemania' => 'Alemania',
                'Italia' => 'Italia',
                'Portugal' => 'Portugal',
            ], 'placeholder' => 'Selecciona un pais', 'label' => 'Pais']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            $resolver->setDefaults([
                'data_class' => PersonaEntity::class,
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
            ]),
        ]);
    }
}
