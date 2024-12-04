<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Enum\ChambreEtat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nb_lits')
            ->add('prix')
            ->add('etage')
            ->add('style')
            ->add('etat', ChoiceType::class, [
                'choices' => ChambreEtat::cases(),
                'choice_label' => fn(ChambreEtat $etat) => $etat->name,
                'choice_value' => fn(?ChambreEtat $etat) => $etat?->value,
            ])

        ->add('hotel', EntityType::class, [
        'class' => Hotel::class,
        'choice_label' => 'nom',
        'placeholder' => 'Choisissez un hôtel',
        'required' => true,
    ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
