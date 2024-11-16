<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num_reservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jour_Arr = null;

    #[ORM\Column]
    private ?int $nb_jours = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jour_Dep = null;

    #[ORM\Column(length: 255)]
    private ?string $reservEtat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumReservation(): ?int
    {
        return $this->num_reservation;
    }

    public function setNumReservation(int $num_reservation): static
    {
        $this->num_reservation = $num_reservation;

        return $this;
    }

    public function getJourArr(): ?\DateTimeInterface
    {
        return $this->jour_Arr;
    }

    public function setJourArr(\DateTimeInterface $jour_Arr): static
    {
        $this->jour_Arr = $jour_Arr;

        return $this;
    }

    public function getNbJours(): ?int
    {
        return $this->nb_jours;
    }

    public function setNbJours(int $nb_jours): static
    {
        $this->nb_jours = $nb_jours;

        return $this;
    }

    public function getJourDep(): ?\DateTimeInterface
    {
        return $this->jour_Dep;
    }

    public function setJourDep(\DateTimeInterface $jour_Dep): static
    {
        $this->jour_Dep = $jour_Dep;

        return $this;
    }

    public function getReservEtat(): ?string
    {
        return $this->reservEtat;
    }

    public function setReservEtat(string $reservEtat): static
    {
        $this->reservEtat = $reservEtat;

        return $this;
    }
}
