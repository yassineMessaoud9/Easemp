<?php

namespace App\Form;

use App\Entity\Findemp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FindempType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Company Name',
            ])
            ->add('domaine', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Domaine',
            ])
            ->add('nbremp', IntegerType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Number of employees',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Email',
            ])
            ->add('numero', NumberType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Phone Number',
            ])
            ->add('place', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Location',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Findemp::class,
            'attr'=>['novalidate'=>'novalidate']

        ]);
    }
}
