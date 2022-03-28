<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DemandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DemandesRepository::class)
 */
class Demandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateAffectation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groupeAffectation;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $datePlanif;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateReal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\OneToOne(targetEntity=SBO::class, cascade={"persist", "remove"})
     */
    private $sbo;

    /**
     * @ORM\OneToOne(targetEntity=Controle::class, cascade={"persist", "remove"})
     */
    private $controle;

    /**
     * @ORM\OneToOne(targetEntity=Maintenance::class, cascade={"persist", "remove"})
     */
    private $maintenance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateAffectation(): ?\DateTimeImmutable
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(?\DateTimeImmutable $dateAffectation): self
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    public function getGroupeAffectation(): ?string
    {
        return $this->groupeAffectation;
    }

    public function setGroupeAffectation(?string $groupeAffectation): self
    {
        $this->groupeAffectation = $groupeAffectation;

        return $this;
    }

    public function getDatePlanif(): ?\DateTimeImmutable
    {
        return $this->datePlanif;
    }

    public function setDatePlanif(?\DateTimeImmutable $datePlanif): self
    {
        $this->datePlanif = $datePlanif;

        return $this;
    }

    public function getDateReal(): ?\DateTimeImmutable
    {
        return $this->dateReal;
    }

    public function setDateReal(?\DateTimeImmutable $dateReal): self
    {
        $this->dateReal = $dateReal;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSbo(): ?SBO
    {
        return $this->sbo;
    }

    public function setSbo(?SBO $sbo): self
    {
        $this->sbo = $sbo;

        return $this;
    }

    public function getControle(): ?Controle
    {
        return $this->controle;
    }

    public function setControle(?Controle $controle): self
    {
        $this->controle = $controle;

        return $this;
    }

    public function getMaintenance(): ?Maintenance
    {
        return $this->maintenance;
    }

    public function setMaintenance(?Maintenance $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }
}
