<?php

namespace App\Entity;

use App\Enum\ChambreEtat;
use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $nb_lits = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $etage = null;

    #[ORM\Column(length: 255)]
    private ?string $style = null;

    #[ORM\Column(type: 'string', enumType: ChambreEtat::class)]
    private ?ChambreEtat $etat = null;

    #[ORM\ManyToOne(inversedBy: 'chambre')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hotel $hotel = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNbLits(): ?int
    {
        return $this->nb_lits;
    }

    public function setNbLits(int $nb_lits): static
    {
        $this->nb_lits = $nb_lits;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function getEtat(): ?ChambreEtat
    {
        return  $this->etat;
    }

    public function setEtat(ChambreEtat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
