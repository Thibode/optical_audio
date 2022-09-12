<?php

namespace App\Form;

use App\Entity\Opticiens;
use App\Entity\PotentielClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FormPotentielClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('opticien',EntityType::class, [
                'class' => Opticiens::class,
            ])
            ->add('dateTest', DateType::class)
            ->add('appareil', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ]
            ])
            ->add('perteAuditive', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                    'PRESBYACOUSIE' => PotentielClient::PRESBYACOUSIE,
                ]
            ])
            ->add('deni', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ]
            ])
            ->add('souhait', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ]
            ])
            ->add('remarque', TextareaType::class, [
                'attr' => ['cols' => 83]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PotentielClient::class,
        ]);
    }
}
