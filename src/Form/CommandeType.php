<?php

namespace App\Form;
use App\Entity\Client;
use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numc')
            ->add('dateComm',DateType::class,['label' => 'Date Commande:   : ','widget' => 'single_text'])
            ->add('client',EntityType::class,array('class' => Client::class,'choice_label' => 'libelle' ))
            ->add('observation', TextType::class, array(
                'label' => 'Observation : '))
            ->add('totht', TextType::class, array(
                'label' => 'Total Ht : '))
            ->add('tottva', TextType::class, array(
                'label' => 'Total Tva : '))
            ->add('totttc', TextType::class, array(
                'label' => 'Total TTC :'))
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
