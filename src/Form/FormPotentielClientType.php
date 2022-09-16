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
            ->add('lastname', TextType::class, [
                'attr' => ['tabindex' => 1]
            ])
            ->add('firstname', TextType::class, [
                'attr' => ['tabindex' => 2]
            ])
            ->add('email', TextType::class, [
                'attr' => ['tabindex' => 3]
            ])
            ->add('phone', TextType::class, [
                'attr' => ['tabindex' => 4]
            ])
            ->add('opticien',EntityType::class, [
                'class' => Opticiens::class,
                'attr' => ['tabindex' => 6]
            ])
            ->add('dateTest', DateType::class, [
                'attr' => ['tabindex' => 5]
            ])
            ->add('appareil', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ], 'attr' => ['tabindex' => 8]
            ])
            ->add('perteAuditive', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                    'PRESBYACOUSIE' => PotentielClient::PRESBYACOUSIE,
                ],  'attr' => ['tabindex' => 7]
            ])
            ->add('deni', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ], 'attr' => ['tabindex' => 10]
            ])
            ->add('souhait', ChoiceType::class, [
                'choices' => [
                    'OUI' => PotentielClient::OUI,
                    'NON' => PotentielClient::NON,
                ],  'attr' => ['tabindex' => 9]
            ])
            ->add('remarque', TextareaType::class, [
                'attr' => [
                    'cols' => 50,
                    'rows' => 5
                ],
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
