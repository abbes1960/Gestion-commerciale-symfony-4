<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code',TextType::class, array('label' => 'Code Fournisseur : '))
            ->add('libelle',TextType::class, array('label' => 'Libelle : '))
            ->add('responsable',TextType::class, array('label' => 'Responsable : '))
            ->add('adresse',TextType::class, array('label' => 'Adresse : '))
            ->add('ville',TextType::class, array('label' => 'Ville : '))
            ->add('tel',TextType::class, array('label' => 'Téléphonne : '))
            ->add('portable',TextType::class, array('label' => 'Portable : '))
            ->add('email',TextType::class, array('label' => 'Email : '))
            ->add('matfisc',TextType::class, array('label' => 'Matricule Fiscale : '))
            ->add('cin',TextType::class, array('label' => 'CIN : '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
