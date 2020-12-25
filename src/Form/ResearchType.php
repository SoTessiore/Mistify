<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post_name', SearchType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('post_category', ChoiceType::class, [
                'choices' => [
                    'Choisir une categorie' => 0,
                    'Combat' => 1,
                    'Plateformes' => 2,
                    'Tir' => 3,
                    'Aventure' => 4,
                    'Action-aventure' => 5,
                    'Jeu de rôle' => 6,
                    'Réflexion' => 7,
                    'Simulation' => 8,
                    'Sport' => 9
                ],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
