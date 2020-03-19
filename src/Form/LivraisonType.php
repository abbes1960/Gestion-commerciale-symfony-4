<?php

namespace App\Form;
use App\Entity\Client;
use App\Entity\Livraison;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numl')
            ->add('dateliv',DateType::class,['label' => 'Date livraison:   : ','widget' => 'single_text'])
            ->add('observation')
            ->add('totht')
            ->add('tottva')
            ->add('totttc')
            ->add('client',EntityType::class,array('class' => Client::class,'choice_label' => 'libelle' ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }

}
