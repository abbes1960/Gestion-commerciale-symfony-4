<?php

namespace App\Form;
use App\Entity\Produit;
use App\Entity\Famille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class,['label' => 'Base 0 : '])
            ->add('pa',TextType::class, ['label' => 'Prix Achat : '])
            ->add('pv',TextType::class, ['label' => 'Prix Vente : '])
            ->add('tva',TextType::class,['label' => 'Tva : '])
            ->add('stock',TextType::class,['label' => 'Stock : '])
            ->add('image' , FileType::class, ['label' => 'Image : '] )
            ->add('famille', EntityType::class, ['label' => 'Image : ',
                'class' => Famille::class,
                 'choice_label' => 'libelle',
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
