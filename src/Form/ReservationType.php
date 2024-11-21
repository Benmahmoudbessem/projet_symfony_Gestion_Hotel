<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Enum\ChambreEtat;
use App\Enum\ReservationEtat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_reservation')
            ->add('jour_Arr', null, [
                'widget' => 'single_text',
            ])
            ->add('nb_jours')
            ->add('jour_Dep', null, [
                'widget' => 'single_text',
            ])
            ->add('reservEtat', ChoiceType::class, [
                'choices' => ReservationEtat::cases(),
                'choice_label' => fn(ReservationEtat $reservEtat) => $reservEtat->name,
                'choice_value' => fn(?ReservationEtat $reservEtat) => $reservEtat?->value, // Stocke la valeur dans le formulaire
            ])
            ->add('client', ClientType::class, [
                'label' => 'Informations du client', // Optionnel : définir un label pour le formulaire client
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
