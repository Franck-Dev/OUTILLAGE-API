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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Tool::class, inversedBy="demandes")
     */
    private $toolSAP;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateBesoin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $demandeur;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getToolSAP(): ?Tool
    {
        return $this->toolSAP;
    }

    public function setToolSAP(?Tool $toolSAP): self
    {
        $this->toolSAP = $toolSAP;

        return $this;
    }

    public function getDateBesoin(): ?\DateTimeImmutable
    {
        return $this->dateBesoin;
    }

    public function setDateBesoin(?\DateTimeImmutable $dateBesoin): self
    {
        $this->dateBesoin = $dateBesoin;

        return $this;
    }

    public function getDemandeur(): ?string
    {
        return $this->demandeur;
    }

    public function setDemandeur(string $demandeur): self
    {
        $this->demandeur = $demandeur;

        return $this;
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
}
