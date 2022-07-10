<?php

namespace App\Form;

use App\Entity\Emplopyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class EmplopyerType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder

            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'First Name',
            ])
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Last Name',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Email',
            ])
            ->add('numerotel', NumberType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Phone Number',
            ])

            ->add('specialite', ChoiceType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Speciality',
                'choices' => array(
                    'Select' => null,
                    'Nurses' => 'nurses',
                    'Doctors' => 'Doctors',
                    'Engineers' => 'Engineers',
                    'IT-Specialist' => 'IT-Specialist',
                    'Anesthetist technicians' => 'Anesthetist technicians',
                    'Others' => 'Others',
                ),
                'choice_attr' => [
                    'Select' => ['disabled'=>'disabled'],
                ]
                
            ])
            ->add('otherspec', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => null,
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'description',
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Adress',
            ])
            ->add('cv', FileType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'label' => 'Curriculum Vitae (CV)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '40M',
                        'mimeTypes' => ['application/pdf', 'application/x-pdf'],
                        'mimeTypesMessage' => 'Please upload a valid File',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emplopyer::class,
            'attr'=>['novalidate'=>'novalidate']
        ]);
    }
}
