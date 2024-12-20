<?php

namespace App\Entity;

use App\Enum\ReservationEtat;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(enumType: ReservationEtat::class)]
    private ReservationEtat $reservEtat;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\Cascade(["persist"])]
    private ?Client $client ;

    /**
     * @var Collection<int, Chambre>
     */
    #[ORM\ManyToMany(targetEntity: Chambre::class)]
    private Collection $chambre;



    public function __construct()
    {
        $this->chambre = new ArrayCollection();
    }

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

    public function getReservEtat(): ?ReservationEtat
    {
        return $this->reservEtat;
    }

    public function setReservEtat(ReservationEtat $reservEtat): self
    {
        $this->reservEtat = $reservEtat;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(Chambre $chambre): static
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre->add($chambre);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): static
    {
        $this->chambre->removeElement($chambre);

        return $this;
    }



}
