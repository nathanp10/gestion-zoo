<?php

namespace App\Form;

use App\Entity\Animaux;
use App\Entity\Enclos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('animaux')
            ->add('NID')
            ->add('arrive')
            ->add('depart')
            ->add('proprietaire')
            ->add('Genre')
            ->add('espece')
            ->add('MF_ND')
            ->add('sterilise')
            ->add('quarantaine')

            ->add('Enclos', EntityType::class, [
                'class'=>Enclos::class,
                'choice_label'=>"nom",
                'multiple'=>false,
                'expanded'=>false
            ])

            ->add("ok", SubmitType::class, ["label"=>"OK"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animaux::class,
        ]);
    }
}
