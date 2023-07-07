<?php

namespace App\Form;


use App\Model\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('km', ChoiceType::class, [
            'label' => 'Kilométrage',
            'choices' => $options['data']->getKmChoices(),
            'expanded' => true,
            'multiple' => false,
            'required' => false,
            'placeholder' => false,
            'attr' => [
                'class' => 'custom-radio',
            ],
        ])
        ->add('selectKm', SubmitType::class, [
            'label' => 'Valider km',
            'attr' => [
                'class' => 'btn_form mb-1 text-center',
                'style' => 'width: 100%; padding: 0; margin-top: 15px; margin-left: 0px; text-align: left;',
            ],
        ])

        
        ->add('prix', ChoiceType::class, [
            'label' => 'Prix',
            'choices' => $options['data']->getPricesChoices(),
            'expanded' => true,
            'multiple' => false,
            'required' => false,
            'placeholder' => false,
            'attr' => [
                'class' => 'custom-radio',
            ],
        ])
        ->add('selectPrix', SubmitType::class, [
            'label' => 'Valider Prix',
            'attr' => [
                'class' => 'btn_form mb-1 text-center',
                'style' => 'width: 100%; padding: 0; margin-top: 15px; margin-left: 0px; text-align: left;',
            ],
        ])
        
      
        ->add('annee', ChoiceType::class, [
            'label' => 'Année',
            'choices' => $options['data']->getYearsChoices(),
            'expanded' => true,
            'multiple' => false,
            'required' => false,
            'placeholder' => false,
            'attr' => [
                'class' => 'custom-radio',
            ],
        ])

        ->add('selectAnnee', SubmitType::class, [
            'label' => 'Valider année',
            'attr' => [
                'class' => 'btn_form mb-1 text-center',
                'style' => 'width: 100%; padding: 0; margin-top: 15px; margin-left: 0px; text-align: left;',
            ],
        ])

        ->add('selectRAZ', SubmitType::class, [
            'label' => 'RAZ',
            'attr' => [
                'class' => 'btn_form mb-1 text-center bg-primary',
                'style' => 'width: 100%; padding: 0; margin-top: 15px; margin-left: 0px; text-align: left;',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'POST',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
