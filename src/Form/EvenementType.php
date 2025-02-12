<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Guide;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Enum\Status;


class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('date', null, [
                'widget' => 'single_text'
            ])
            ->add('lieu')
            ->add('description')
            ->add('photo')
            ->add('place_max')
            ->add('prix')
            ->add('status')
            
            
            ->add('inetresse')
            ->add('guide', EntityType::class, [
                'class' => Guide::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
