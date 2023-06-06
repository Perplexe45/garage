<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\EmailType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;  

class AjoutEmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('nom',TextType::class, [
            'label' => false,
            'constraints' => new Length([
                'min' => 3,
                'max' =>20    
            ]),
            'attr' => [
                'placeholder' => 'Nom'
            ]
        ])
        ->add('prenom', TextType::class, [
            'label' => false,
            'constraints' => new Length([
                'min' => 3,
                'max' =>20    
            ]),
            'attr' => [
                'placeholder' => 'Prénom'
            ]
        ])

         ->add('adresse',TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Adresse'
            ]
        ])

        ->add('code_postal',TextType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 5,
                'max' => 5   
            ]),
            'attr' => [
                'placeholder' => 'Code postal'
            ]
        ])

        ->add('ville',TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Ville'
            ]
        ])

        ->add('telephone',TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Téléphone'
            ]
        ])

        ->add('email', EmailType::class, [
            'label' => false,
            'constraints' => new Email(),
            'attr' => [
                'placeholder' => 'Email'
            ]
        ])

        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent être identiques',
            'required' => true,
            'first_options'  => [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => 'Saisir mot de passe ']
            ],
            'second_options' => [
                'label' => 'Répétez mot de passe',
                'attr' => ['placeholder' => 'Confirmer mot de passe '],
                'mapped' => false,
            ],
            
            'attr' => [
                'autocomplete' => 'new-password'//pas d'auto-complétion au raffraichissement du navigateur
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez renseigner un mot de passe',
                ]),
                new Length([
                    'min' => 4,
                    'minMessage' => 'Votre mot de passe doit contenir minimum 4 caractères',
                    'max' => 4096,
                ]),
            ],
        ])

        ->add('submit', SubmitType::class, [
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-outline-success'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
