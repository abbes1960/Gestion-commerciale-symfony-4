<?php

namespace App\Form;
use App\Entity\Client;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('client',EntityType::class,array('class' => Client::class,'choice_label' => 'libelle' ))
            ->add('base0',TextType::class, array('label' => 'Base 0 : '))
            ->add('base1',TextType::class, array('label' => 'Base 7 : '))
            ->add('tva1', TextType::class, array('label' => 'Tva 7 : '))
            ->add('base2', TextType::class, array('label' => 'Base 13 : '))
            ->add('tva2', TextType::class, array('label' => 'Tva 13 : '))
            ->add('base3', TextType::class, array('label' => 'Base 19 : '))
            ->add('tva3', TextType::class, array('label' => 'Tva 19 : '))
            ->add('totht', TextType::class, array('label' => 'Total Ht : '))
            ->add('totrem', TextType::class, array('label' => 'Total Remise : '))
            ->add('tottva', TextType::class, array('label' => 'Total Tva : '))
            ->add('timbre', TextType::class, array('label' => 'Timbre : '))
            ->add('tottc', TextType::class, array('label' => 'Total TTC : '))
            ->add('rs', TextType::class, array('label' => 'Retenue Source : '))
            ->add('montrs', TextType::class, array('label' => 'Total Rs : '))
            ->add('net', TextType::class, array('label' => 'Nét à Payer : '))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
