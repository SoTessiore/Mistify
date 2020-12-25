<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post_name', TextType::class, array(
                'label' => false,
            ))
            ->add('post_description', TextareaType::class, array(
                'label' => false,
            ))
            ->add('post_category', ChoiceType::class, [
                'choices' => [
                    'Combat' => 0,
                    'Plateformes' => 1,
                    'Tir' => 2,
                    'Aventure' => 3,
                    'Action-aventure' => 4,
                    'Jeu de rôle' => 5,
                    'Réflexion' => 6,
                    'Simulation' => 7,
                    'Sport' => 8
                ],
                'label' => false,
            ])
            ->add('post_download_link', TextType::class, [
                'label' => false,
            ])
            ->add('post_image', FileType::class, [
                'label' => false,
                'mapped' => false
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
