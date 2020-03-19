<?php

namespace App\Form;
use  App\Entity\Client;
use  App\Entity\Facture;
use App\Entity\Reglement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ReglementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modereg', ChoiceType::class, array(
                'choices'  => array(
                    'Espéce' => 'e',
                    'Cheque' => 'c',
                  
                )))
            ->add('montant')
            ->add('numpiece')
            ->add('echeance')
            ->add('client',EntityType::class,array('class' => Client::class,'choice_label' => 'libelle' ))
            ->add('facture' ,EntityType::class,array('class' => Facture::class,'choice_label' => 'base0' ))
            ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reglement::class,
        ]);
    }
}
