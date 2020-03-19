<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, array(
                'label' => 'Code Client : '))
            ->add('libelle', TextType::class, array(
                'label' => 'Désignation Client '))
            ->add('responsable', TextType::class, array(
                'label' => 'Responsable  :'))
            ->add('adresse', TextType::class, array(
                'label' => 'Adresse  Client :'))
            ->add('ville', TextType::class, array(
                'label' => 'Ville :  '))
            ->add('tel', TextType::class, array(
                'label' => 'Téléphonne : '))
            ->add('portable', TextType::class, array(
                'label' => 'Portable : '))
            ->add('email', TextType::class, array(
                'label' => 'Email :'))
            ->add('matfisc', TextType::class, array(
                'label' => 'Matricule Fiscale : '))
            ->add('cin', TextType::class, array(
                'label' => 'CIN : '))
                ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
