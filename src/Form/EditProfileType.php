<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_firstname', TextType::class, array(
                'label' => false,
            ))
            ->add('user_lastname', TextType::class, array(
                'label' => false,
            ))
            ->add('user_pseudo', TextType::class, array(
                'label' => false,
            ))
            ->add('user_mail', EmailType::class, array(
                'label' => false,
            ))
            ->add('user_born', BirthdayType::class, array(
                'label' => false,
            ))
            ->add('user_avatar', FileType::class, [
                'mapped' => false,
                'label' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
